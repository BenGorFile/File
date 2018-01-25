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

namespace spec\BenGorFile\File\Application\Command\Upload;

use BenGorFile\File\Application\Command\Upload\SuffixNumberUploadFileCommand;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileAlreadyExistsException;
use BenGorFile\File\Domain\Model\FileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;
use BenGorFile\File\Domain\Model\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of SuffixNumberUploadFileHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SuffixNumberUploadFileHandlerSpec extends ObjectBehavior
{
    private $id;
    private $name;
    private $uploadedFile;
    private $mimeType;

    function let(
        Filesystem $filesystem,
        FileRepository $repository,
        FileFactory $factory,
        FileSpecificationFactory $specificationFactory,
        SuffixNumberUploadFileCommand $command
    ) {
        $this->beConstructedWith($filesystem, $repository, $specificationFactory, $factory);

        $this->id = new FileId('file-id');
        $this->name = new FileName('dummy-file-name.pdf');
        $this->uploadedFile = 'test-content';
        $this->mimeType = new FileMimeType('application/pdf');

        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file-name.pdf');
        $command->uploadedFile()->shouldBeCalled()->willReturn('test-content');
        $command->mimeType()->shouldBeCalled()->willReturn('application/pdf');
    }

    function it_does_not_handle_because_file_id_already_exists(
        FileRepository $repository,
        SuffixNumberUploadFileCommand $command,
        File $file
    ) {
        $repository->fileOfId($this->id)->shouldBeCalled()->willReturn($file);
        $this->shouldThrow(FileAlreadyExistsException::class)->during__invoke($command);
    }

    function it_handles_without_same_name(
        SuffixNumberUploadFileCommand $command,
        Filesystem $filesystem,
        FileRepository $repository,
        FileFactory $factory,
        File $file
    ) {
        $repository->fileOfId($this->id)->shouldBeCalled()->willReturn(null);
        $repository->length(Argument::any())->shouldBeCalled()->willReturn(0);
        $filesystem->write($this->name, $this->uploadedFile)->shouldBeCalled();
        $factory->build($this->id, $this->name, $this->mimeType)->shouldBeCalled()->willReturn($file);
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_handles(
        SuffixNumberUploadFileCommand $command,
        Filesystem $filesystem,
        FileRepository $repository,
        FileFactory $factory,
        File $file
    ) {
        $repository->fileOfId($this->id)->shouldBeCalled()->willReturn(null);
        $repository->length(Argument::any())->shouldBeCalled()->willReturn(2);
        $filesystem->write('dummy-file-name-3.pdf', $this->uploadedFile)->shouldBeCalled();
        $factory->build($this->id, 'dummy-file-name-3.pdf', $this->mimeType)->shouldBeCalled()->willReturn($file);
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }
}
