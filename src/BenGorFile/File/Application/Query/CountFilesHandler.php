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

use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;

/**
 * Counts files with the given query.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class CountFilesHandler
{
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
     */
    public function __construct(FileRepository $aRepository, FileSpecificationFactory $fileSpecificationFactory)
    {
        $this->repository = $aRepository;
        $this->specificationFactory = $fileSpecificationFactory;
    }

    /**
     * Handles the given query.
     *
     * @param CountFilesQuery $aQuery The query
     *
     * @return mixed
     */
    public function __invoke(CountFilesQuery $aQuery)
    {
        return $this->repository->length(
            $this->specificationFactory->buildFilterByNameSpecification(
                $aQuery->query()
            )
        );
    }
}
