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
use BenGorFile\File\Application\Query\FileOfIdHandler;
use BenGorFile\File\Application\Query\FileOfIdQuery;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileRepository;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileOfIdHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfIdHandlerSpec extends ObjectBehavior
{
    function let(FileRepository $repository, FileDataTransformer $dataTransformer)
    {
        $this->beConstructedWith($repository, $dataTransformer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileOfIdHandler::class);
    }

    function it_gets_the_file(
        FileOfIdQuery $query,
        FileRepository $repository,
        File $file,
        FileDataTransformer $dataTransformer,
        \DateTimeImmutable $createdOn,
        \DateTimeImmutable $updatedOn
    ) {
        $query->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn($file);
        $dataTransformer->write($file)->shouldBeCalled();

        $dataTransformer->read()->shouldBeCalled()->willReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'image.jpeg',
            'updated_on' => $updatedOn,
        ]);

        $this->__invoke($query)->shouldReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'image.jpeg',
            'updated_on' => $updatedOn,
        ]);
    }

    function it_does_not_get_the_file_because_the_id_does_not_exist(
        FileRepository $repository,
        FileOfIdQuery $query
    ) {
        $query->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileDoesNotExistException::class)->during__invoke($query);
    }
}
