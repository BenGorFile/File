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

namespace BenGorFile\File\Application\Command\Upload;

use BenGorFile\File\Domain\Model\FileAlreadyExistsException;
use BenGorFile\File\Domain\Model\FileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;
use BenGorFile\File\Domain\Model\Filesystem;

/**
 * Upload with suffix number file handler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SuffixNumberUploadFileHandler
{
    /**
     * The file factory.
     *
     * @var FileFactory
     */
    private $factory;

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
     * The specification factory.
     *
     * @var FileSpecificationFactory
     */
    private $specificationFactory;

    /**
     * Constructor.
     *
     * @param Filesystem               $filesystem            The filesystem
     * @param FileRepository           $aRepository           The file repository
     * @param FileSpecificationFactory $aSpecificationFactory The file specification factory
     * @param FileFactory              $aFactory              The file factory
     */
    public function __construct(
        Filesystem $filesystem,
        FileRepository $aRepository,
        FileSpecificationFactory $aSpecificationFactory,
        FileFactory $aFactory
    ) {
        $this->factory = $aFactory;
        $this->filesystem = $filesystem;
        $this->repository = $aRepository;
        $this->specificationFactory = $aSpecificationFactory;
    }

    /**
     * Handles the given command.
     *
     * @param SuffixNumberUploadFileCommand $aCommand The command
     *
     * @throws FileAlreadyExistsException when file is already exists
     */
    public function __invoke(SuffixNumberUploadFileCommand $aCommand)
    {
        $id = $aCommand->id();
        $name = $aCommand->name();
        $uploadedFile = $aCommand->uploadedFile();
        $mimeType = $aCommand->mimeType();

        $fileId = new FileId($id);
        $fileName = new FileName($name);
        $fileMimeType = new FileMimeType($mimeType);

        $this->checkFileExists($fileId);
        $fileName = $this->buildName($fileName);
        $this->filesystem->write($fileName, $uploadedFile);
        $file = $this->factory->build($fileId, $fileName, $fileMimeType);
        $this->repository->persist($file);
    }

    private function checkFileExists(FileId $id)
    {
        $file = $this->repository->fileOfId($id);
        if (null !== $file) {
            throw new FileAlreadyExistsException();
        }
    }

    private function buildName(FileName $fileName)
    {
        $name = $fileName->name();
        $extension = $fileName->extension();

        $numberOfFiles = $this->repository->count(
            $this->specificationFactory->buildFilterByNameSpecification($fileName->name())
        );

        if ($numberOfFiles > 0) {
            $name = sprintf('%s-%s', $name, $numberOfFiles + 1);
        }
        $fileName = sprintf('%s.%s', $name, $extension);

        return new FileName($fileName);
    }
}
