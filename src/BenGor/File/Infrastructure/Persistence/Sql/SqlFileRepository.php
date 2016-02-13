<?php

/*
 * This file is part of the BenGorFile library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGor\File\Infrastructure\Persistence\Sql;

use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileRepository;

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
     * Constructor.
     *
     * @param \PDO $aPdo The pdo instance
     */
    public function __construct(\PDO $aPdo)
    {
        $this->pdo = $aPdo;
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
    public function fileOfName($aName)
    {
        $statement = $this->execute('SELECT * FROM file WHERE name = :name', ['name' => $aName]);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildFile($row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function persist(File $aFile)
    {
        ($this->exist($aFile)) ? $this->update($aFile) : $this->insert($aFile);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(File $aFile)
    {
        $this->execute('DELETE FROM file WHERE id = :id', ['id' => $aFile->id()->id()]);
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        return $this->pdo->query('SELECT COUNT(*) FROM file')->fetchColumn();
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity()
    {
        return new FileId();
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
        $sql = 'INSERT INTO user (id, name, created_on, updated_on) VALUES (:id, :name, :createdOn, :updatedOn)';
        $this->execute($sql, [
            'id'        => $aFile->id()->id(),
            'name'      => $aFile->name(),
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
        $this->execute('UPDATE file SET name = :name, updated_on = :updatedOn WHERE id = :id', [
            'id'        => $aFile->id()->id(),
            'updatedOn' => $aFile->updatedOn(),
        ]);
    }

    /**
     * Wrapper that encapsulates the same
     * logic about execute the query in PDO.
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
        return new File(
            new FileId($row['id']),
            $row['name'],
            new \DateTimeImmutable($row['created_on']),
            new \DateTimeImmutable($row['updated_on'])
        );
    }
}
