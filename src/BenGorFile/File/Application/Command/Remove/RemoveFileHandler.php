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

namespace BenGorFile\File\Application\Command\Remove;

use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;

/**
 * Remove file handler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RemoveFileHandler
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
     * @param RemoveFileCommand $aCommand The command
     *
     * @throws FileDoesNotExistException when file is already exists
     */
    public function __invoke(RemoveFileCommand $aCommand)
    {
        $id = new FileId($aCommand->id());

        $file = $this->repository->fileOfId($id);
        if (null === $file) {
            throw new FileDoesNotExistException();
        }
        $this->filesystem->delete($file->name());

        $this->repository->remove($file);
    }
}
