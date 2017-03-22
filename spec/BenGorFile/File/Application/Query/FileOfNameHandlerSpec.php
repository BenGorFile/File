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
use BenGorFile\File\Application\Query\FileOfNameHandler;
use BenGorFile\File\Application\Query\FileOfNameQuery;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of FileOfNameHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfNameHandlerSpec extends ObjectBehavior
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
        $this->shouldHaveType(FileOfNameHandler::class);
    }

    function it_gets_the_file(
        FileOfNameQuery $query,
        FileRepository $repository,
        File $file,
        FileDataTransformer $dataTransformer,
        \DateTimeImmutable $createdOn,
        \DateTimeImmutable $updatedOn
    ) {
        $query->name()->shouldBeCalled()->willReturn('file.pdf');
        $repository->singleResultQuery(Argument::any())->shouldBeCalled()->willReturn($file);
        $dataTransformer->write($file)->shouldBeCalled();

        $dataTransformer->read()->shouldBeCalled()->willReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'file.pdf',
            'updated_on' => $updatedOn,
        ]);

        $this->__invoke($query)->shouldReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'file.pdf',
            'updated_on' => $updatedOn,
        ]);
    }

    function it_does_not_get_the_file_because_the_name_does_not_exist(
        FileRepository $repository,
        FileOfNameQuery $query
    ) {
        $query->name()->shouldBeCalled()->willReturn('file.pdf');
        $repository->singleResultQuery(Argument::any())->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileDoesNotExistException::class)->during__invoke($query);
    }
}
