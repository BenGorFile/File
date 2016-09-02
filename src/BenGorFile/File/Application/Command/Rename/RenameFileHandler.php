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

namespace BenGorFile\File\Application\Command\Rename;

use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;

/**
 * Rename file handler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RenameFileHandler
{
    /**
     * The filesystem.
     *
     * @var Filesystem
     */
    private $filesystem;

    /**
     * The file repository.
     *
     * @var FileRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param Filesystem     $filesystem  The filesystem
     * @param FileRepository $aRepository The file repository
     */
    public function __construct(Filesystem $filesystem, FileRepository $aRepository)
    {
        $this->filesystem = $filesystem;
        $this->repository = $aRepository;
    }

    /**
     * Handles the given command.
     *
     * @param RenameFileCommand $aCommand The command
     *
     * @throws FileDoesNotExistException when file does not exist
     */
    public function __invoke(RenameFileCommand $aCommand)
    {
        $id = new FileId($aCommand->id());
        $name = new FileName($aCommand->name());

        $file = $this->repository->fileOfId($id);
        if (null === $file) {
            throw new FileDoesNotExistException();
        }
        $this->filesystem->rename($file->name(), $name);
        $file->rename($name);

        $this->repository->persist($file);
    }
}
