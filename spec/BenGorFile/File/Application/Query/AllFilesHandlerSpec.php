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
use BenGorFile\File\Application\Query\AllFilesHandler;
use BenGorFile\File\Application\Query\AllFilesQuery;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileRepository;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of AllFilesHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AllFilesHandlerSpec extends ObjectBehavior
{
    function let(FileRepository $repository, FileDataTransformer $dataTransformer)
    {
        $this->beConstructedWith($repository, $dataTransformer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AllFilesHandler::class);
    }

    function it_gets_files_when_the_list_has_one_file(
        AllFilesQuery $query,
        FileRepository $repository,
        File $file,
        FileDataTransformer $dataTransformer,
        \DateTimeImmutable $createdOn,
        \DateTimeImmutable $updatedOn
    ) {
        $repository->all()->shouldBeCalled()->willReturn([$file]);
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

    function it_gets_files_when_the_list_is_empty(AllFilesQuery $query, FileRepository $repository)
    {
        $repository->all()->shouldBeCalled()->willReturn([]);

        $this->__invoke($query)->shouldReturn([]);
    }
}
