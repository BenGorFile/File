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
use BenGorFile\File\Application\Query\ListFilesOfIdsHandler;
use BenGorFile\File\Application\Query\ListFilesOfIdsQuery;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ListFilesOfIdsHandlerSpec extends ObjectBehavior
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
        $this->shouldHaveType(ListFilesOfIdsHandler::class);
    }

    function it_lists_when_the_result_of_ids_has_one_file(
        ListFilesOfIdsQuery $query,
        FileRepository $repository,
        FileSpecificationFactory $specificationFactory,
        File $file,
        FileDataTransformer $dataTransformer,
        \DateTimeImmutable $createdOn,
        \DateTimeImmutable $updatedOn
    ) {
        $query->ids()->shouldBeCalled()->willReturn(['id-1']);
        $query->limit()->shouldBeCalled()->willReturn(-1);
        $query->page()->shouldBeCalled()->willReturn(1);
        $specificationFactory->buildListOfIdsSpecification(['id-1'], 0, -1)->shouldBeCalled();
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

    function it_lists_when_the_result_of_ids_has_no_files(
        ListFilesOfIdsQuery $query,
        FileSpecificationFactory $specificationFactory,
        FileRepository $repository
    ) {
        $query->ids()->shouldBeCalled()->willReturn([]);
        $query->limit()->shouldBeCalled()->willReturn(-1);
        $query->page()->shouldBeCalled()->willReturn(1);
        $specificationFactory->buildListOfIdsSpecification([], 0, -1)->shouldBeCalled();
        $repository->query(Argument::any())->shouldBeCalled()->willReturn([]);

        $this->__invoke($query)->shouldReturn([]);
    }
}
