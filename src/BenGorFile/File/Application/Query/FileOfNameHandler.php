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

namespace BenGorFile\File\Application\Query;

use BenGorFile\File\Application\DataTransformer\FileDataTransformer;
use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;

/**
 * File of name query handler.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfNameHandler
{
    /**
     * The file data transformer.
     *
     * @var FileDataTransformer
     */
    private $dataTransformer;

    /**
     * The file repository.
     *
     * @var FileRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param FileRepository      $aRepository      The file repository
     * @param FileDataTransformer $aDataTransformer The file data transformer
     */
    public function __construct(FileRepository $aRepository, FileDataTransformer $aDataTransformer)
    {
        $this->repository = $aRepository;
        $this->dataTransformer = $aDataTransformer;
    }

    /**
     * Handles the given query.
     *
     * @param FileOfNameQuery $aQuery The query
     *
     * @throws FileDoesNotExistException when the file name does not exist
     *
     * @return mixed
     */
    public function __invoke(FileOfNameQuery $aQuery)
    {
        $fileName = new FileName($aQuery->name());
        $file = $this->repository->fileOfName($fileName);
        if (null === $file) {
            throw new FileDoesNotExistException();
        }

        $this->dataTransformer->write($file);

        return $this->dataTransformer->read();
    }
}
