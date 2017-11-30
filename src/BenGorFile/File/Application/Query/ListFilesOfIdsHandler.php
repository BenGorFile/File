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
use BenGorFile\File\Domain\Model\FileSpecificationFactory;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ListFilesOfIdsHandler
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
     * The file specification factory.
     *
     * @var FileSpecificationFactory
     */
    private $specificationFactory;

    /**
     * Constructor.
     *
     * @param FileRepository           $aRepository              The file repository
     * @param FileSpecificationFactory $fileSpecificationFactory The file specification factory
     * @param FileDataTransformer      $aDataTransformer         The file data transformer
     */
    public function __construct(
        FileRepository $aRepository,
        FileSpecificationFactory $fileSpecificationFactory,
        FileDataTransformer $aDataTransformer
    ) {
        $this->repository = $aRepository;
        $this->specificationFactory = $fileSpecificationFactory;
        $this->dataTransformer = $aDataTransformer;
    }

    /**
     * Handles the given query.
     *
     * @param ListFilesOfIdsQuery $aQuery The query
     *
     * @return mixed
     */
    public function __invoke(ListFilesOfIdsQuery $aQuery)
    {
        $offset = $aQuery->limit() * ($aQuery->page() - 1);

        $files = $this->repository->query(
            $this->specificationFactory->buildListOfIdsSpecification(
                $aQuery->ids(),
                $offset,
                $aQuery->limit()
            )
        );

        return array_map(function (File $file) {
            $this->dataTransformer->write($file);

            return $this->dataTransformer->read();
        }, $files);
    }
}
