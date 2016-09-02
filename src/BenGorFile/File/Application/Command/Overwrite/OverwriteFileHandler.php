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

namespace BenGorFile\File\Application\Command\Overwrite;

use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;

/**
 * Overwrite file handler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class OverwriteFileHandler
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
     * @param OverwriteFileCommand $aCommand The command
     *
     * @throws FileDoesNotExistException when file does not exist
     */
    public function __invoke(OverwriteFileCommand $aCommand)
    {
        $id = new FileId($aCommand->id());
        $name = new FileName($aCommand->name());

        $file = $this->repository->fileOfId($id);
        if (null === $file) {
            throw new FileDoesNotExistException();
        }
        $this->filesystem->delete($file->name());
        $file->overwrite($name, new FileMimeType($aCommand->mimeType()));
        $this->filesystem->write($name, $aCommand->uploadedFile());

        $this->repository->persist($file);
    }
}
