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

namespace BenGor\File\Application\Service;

use BenGor\File\Domain\Exception\FileDoesNotExistException;
use BenGor\File\Domain\Exception\UploadedFileDoesNotExistException;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use BenGor\File\Domain\Model\Filesystem;
use Ddd\Application\Service\ApplicationService;

/**
 * Overwrite file service class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class OverwriteFileService implements ApplicationService
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
     * @param FileRepository $aRepository THhe file repository
     */
    public function __construct(Filesystem $filesystem, FileRepository $aRepository)
    {
        $this->filesystem = $filesystem;
        $this->repository = $aRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @var OverwriteFileRequest The override file request
     */
    public function execute($request = null)
    {
        $uploadedFile = $request->uploadedFile();
        $name = new FileName($request->name(), $uploadedFile->extension());

        if (false === $this->filesystem->has($name)) {
            throw new UploadedFileDoesNotExistException();
        }
        $file = $this->repository->fileOfName($name);
        if (null === $file) {
            throw new FileDoesNotExistException();
        }

        $this->filesystem->overwrite($name, $uploadedFile->content());
        $file->overwrite($name);

        $this->repository->persist($file);
    }
}
