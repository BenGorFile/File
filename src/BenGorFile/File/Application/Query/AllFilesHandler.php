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
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileRepository;

/**
 * All files query handler.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AllFilesHandler
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
     * @param AllFilesQuery $aQuery The query
     *
     * @return mixed
     */
    public function __invoke(AllFilesQuery $aQuery)
    {
        $files = $this->repository->all();

        $result = array_map(function (File $file) {
            $this->dataTransformer->write($file);

            return $this->dataTransformer->read();
        }, $files);

        return $result;
    }
}
