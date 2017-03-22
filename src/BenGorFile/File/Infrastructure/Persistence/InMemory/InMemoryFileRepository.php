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

namespace BenGorFile\File\Infrastructure\Persistence\InMemory;

use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Infrastructure\Domain\Model\FileEventBus;

/**
 * In memory file repository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class InMemoryFileRepository implements FileRepository
{
    /**
     * File collection.
     *
     * @var File[]
     */
    private $files;

    /**
     * The file event bus, it can be null.
     *
     * @var FileEventBus|null
     */
    private $eventBus;

    /**
     * Constructor.
     *
     * @param FileEventBus|null $anEventBus The file event bus, it can be null
     */
    public function __construct(FileEventBus $anEventBus = null)
    {
        $this->files = [];
        $this->eventBus = $anEventBus;
    }

    /**
     * {@inheritdoc}
     */
    public function fileOfId(FileId $anId)
    {
        if (isset($this->files[$anId->id()])) {
            return $this->files[$anId->id()];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function query($aSpecification)
    {
        throw new \LogicException('This method is not implemented yet, maybe you can propose a PR :)');
    }

    /**
     * {@inheritdoc}
     */
    public function count($aSpecification)
    {
        throw new \LogicException('This method is not implemented yet, maybe you can propose a PR :)');
    }

    /**
     * {@inheritdoc}
     */
    public function fileOfName(FileName $aName)
    {
        foreach ($this->files as $file) {
            if (true === $file->name()->equals($aName)) {
                return $file;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->files;
    }

    /**
     * {@inheritdoc}
     */
    public function persist(File $aFile)
    {
        $this->files[$aFile->id()->id()] = $aFile;

        if ($this->eventBus instanceof FileEventBus) {
            $this->handle($aFile->events());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove(File $aFile)
    {
        unset($this->files[$aFile->id()->id()]);

        if ($this->eventBus instanceof FileEventBus) {
            $this->handle($aFile->events());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        return count($this->files);
    }
}
