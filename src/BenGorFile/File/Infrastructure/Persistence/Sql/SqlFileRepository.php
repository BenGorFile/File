<?php

/*
 * This file is part of the BenGorFile package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGorFile\File\Infrastructure\Persistence\Sql;

use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Infrastructure\Domain\Model\FileEventBus;

/**
 * Sql file repository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class SqlFileRepository implements FileRepository
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The pdo instance.
     *
     * @var \PDO
     */
    private $pdo;

    /**
     * The file event bus, it can be null.
     *
     * @var FileEventBus|null
     */
    private $eventBus;

    /**
     * Constructor.
     *
     * @param \PDO              $aPdo       The pdo instance
     * @param FileEventBus|null $anEventBus The file event bus, it can be null
     */
    public function __construct(\PDO $aPdo, FileEventBus $anEventBus = null)
    {
        $this->pdo = $aPdo;
        $this->eventBus = $anEventBus;
    }

    /**
     * {@inheritdoc}
     */
    public function fileOfId(FileId $anId)
    {
        $statement = $this->execute('SELECT * FROM file WHERE id = :id', ['id' => $anId->id()]);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildFile($row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fileOfName(FileName $aName)
    {
        $statement = $this->execute('SELECT * FROM file WHERE name = :name AND extension = :extension', [
            'name'      => $aName->name(),
            'extension' => $aName->extension(),
        ]);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildFile($row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $statement = $this->execute('SELECT * FROM file');
        if ($rows = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return array_map(function ($row) {
                return $this->buildFile($row);
            }, $rows);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function persist(File $aFile)
    {
        ($this->exist($aFile)) ? $this->update($aFile) : $this->insert($aFile);

        if ($this->eventBus instanceof FileEventBus) {
            $this->handle($aFile->events());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove(File $aFile)
    {
        $this->execute('DELETE FROM file WHERE id = :id', ['id' => $aFile->id()->id()]);

        if ($this->eventBus instanceof FileEventBus) {
            $this->handle($aFile->events());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        return $this->pdo->query('SELECT COUNT(*) FROM file')->fetchColumn();
    }

    /**
     * Loads the file schema into database create the table
     * with file attribute properties as columns.
     */
    public function initSchema()
    {
        $this->pdo->exec(<<<SQL
DROP TABLE IF EXISTS file;
CREATE TABLE file (
    id CHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    extension VARCHAR(100) NOT NULL,
    mime_type VARCHAR(255) NOT NULL,
    created_on DATETIME NOT NULL,
    updated_on DATETIME NOT NULL
)
SQL
        );
    }

    /**
     * Checks if the file given exists in the database.
     *
     * @param File $aFile The file
     *
     * @return bool
     */
    private function exist(File $aFile)
    {
        $count = $this->execute(
            'SELECT COUNT(*) FROM file WHERE id = :id', [':id' => $aFile->id()->id()]
        )->fetchColumn();

        return $count === 1;
    }

    /**
     * Prepares the insert SQL with the file given.
     *
     * @param File $aFile The file
     */
    private function insert(File $aFile)
    {
        $sql = 'INSERT INTO file (id, name, extension, mime_type, created_on, updated_on) VALUES (:id, :name, :extension, :mimeType, :createdOn, :updatedOn)';
        $this->execute($sql, [
            'id'        => $aFile->id()->id(),
            'name'      => $aFile->name()->name(),
            'extension' => $aFile->name()->extension(),
            'mimeType'  => $aFile->mimeType(),
            'createdOn' => $aFile->createdOn()->format(self::DATE_FORMAT),
            'updatedOn' => $aFile->updatedOn()->format(self::DATE_FORMAT),
        ]);
    }

    /**
     * Prepares the update SQL with the file given.
     *
     * @param File $aFile The file
     */
    private function update(File $aFile)
    {
        $this->execute('UPDATE file SET name = :name, extension = :extension, mime_type = :mimeType, updated_on = :updatedOn WHERE id = :id', [
            'name'      => $aFile->name()->name(),
            'extension' => $aFile->name()->extension(),
            'mimeType'  => $aFile->mimeType(),
            'updatedOn' => $aFile->updatedOn(),
            'id'        => $aFile->id()->id(),
        ]);
    }

    /**
     * Wrapper that encapsulates the same logic about execute the query in PDO.
     *
     * @param string $aSql       The SQL
     * @param array  $parameters Array which contains the parameters of SQL
     *
     * @return \PDOStatement
     */
    private function execute($aSql, array $parameters)
    {
        $statement = $this->pdo->prepare($aSql);
        $statement->execute($parameters);

        return $statement;
    }

    /**
     * Builds the file with the given sql row attributes.
     *
     * @param array $row Array which contains attributes of file
     *
     * @return File
     */
    private function buildFile($row)
    {
        $file = new File(
            new FileId($row['id']),
            new FileName($row['name'] . '.' . $row['extension']),
            new FileMimeType($row['mime_type'])
        );

        $createdOn = new \DateTimeImmutable($row['created_on']);
        $updatedOn = new \DateTimeImmutable($row['updated_on']);

        $file = $this->set($file, 'createdOn', $createdOn);
        $file = $this->set($file, 'updatedOn', $updatedOn);

        return $file;
    }

    /**
     * Populates by Reflection the domain object with the given SQL plain values.
     *
     * @param File   $file          The file domain object
     * @param string $propertyName  The property name
     * @param mixed  $propertyValue The property value
     *
     * @return File
     */
    private function set(File $file, $propertyName, $propertyValue)
    {
        $reflectionFile = new \ReflectionClass($file);
        $reflectionCreatedOn = $reflectionFile->getProperty($propertyName);
        $reflectionCreatedOn->setAccessible(true);
        $reflectionCreatedOn->setValue($file, $propertyValue);

        return $file;
    }

    /**
     * Handles the given events with event bus.
     *
     * @param array $events A collection of file domain events
     */
    private function handle($events)
    {
        foreach ($events as $event) {
            $this->eventBus->handle($event);
        }
    }
}
