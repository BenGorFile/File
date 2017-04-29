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

namespace spec\BenGorFile\File\Application\Query;

use BenGorFile\File\Application\DataTransformer\FileDataTransformer;
use BenGorFile\File\Application\Query\FilterFilesHandler;
use BenGorFile\File\Application\Query\FilterFilesQuery;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of FilterFilesHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FilterFilesHandlerSpec extends ObjectBehavior
{
    function let(
        FileRepository $repository,
        FileSpecificationFactory $specificationFactory,
        FileDataTransformer $dataTransformer
    ) {
        $this->beConstructedWith($repository, $specificationFactory, $dataTransformer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FilterFilesHandler::class);
    }

    function it_filters_files_when_the_list_has_one_file(
        FilterFilesQuery $query,
        FileRepository $repository,
        File $file,
        FileDataTransformer $dataTransformer,
        \DateTimeImmutable $createdOn,
        \DateTimeImmutable $updatedOn
    ) {
        $repository->query(Argument::any())->shouldBeCalled()->willReturn([$file]);
        $dataTransformer->write($file)->shouldBeCalled();

        $dataTransformer->read()->shouldBeCalled()->willReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'image.jpeg',
            'updated_on' => $updatedOn,
        ]);

        $this->__invoke($query)->shouldReturn([[
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'image.jpeg',
            'updated_on' => $updatedOn,
        ]]);
    }

    function it_filters_files_when_the_list_is_empty(FilterFilesQuery $query, FileRepository $repository)
    {
        $repository->query(Argument::any())->shouldBeCalled()->willReturn([]);

        $this->__invoke($query)->shouldReturn([]);
    }
}
