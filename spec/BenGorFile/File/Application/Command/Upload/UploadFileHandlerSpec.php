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

use BenGorFile\File\Application\Command\Upload\UploadFileCommand;
use BenGorFile\File\Application\Command\Upload\UploadFileHandler;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileException;
use BenGorFile\File\Domain\Model\FileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadFileHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileHandlerSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository, FileFactory $factory)
    {
        $this->beConstructedWith($filesystem, $repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UploadFileHandler::class);
    }

    function it_handles(
        UploadFileCommand $command,
        Filesystem $filesystem,
        FileRepository $repository,
        FileFactory $factory,
        File $file
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file-name.pdf');
        $command->uploadedFile()->shouldBeCalled()->willReturn('test-content');
        $command->mimeType()->shouldBeCalled()->willReturn('application/pdf');
        $id = new FileId('file-id');
        $name = new FileName('dummy-file-name.pdf');
        $mimeType = new FileMimeType('application/pdf');

        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);
        $filesystem->has($name)->shouldBeCalled()->willReturn(false);

        $filesystem->write($name, 'test-content')->shouldBeCalled();
        $factory->build($id, $name, $mimeType)->shouldBeCalled()->willReturn($file);
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_does_not_handle_because_file_id_already_exists(
        FileRepository $repository,
        UploadFileCommand $command,
        File $file
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn($file);

        $this->shouldThrow(FileException::idAlreadyExists($id))->during__invoke($command);
    }

    function it_does_not_handle_because_file_already_exists(
        FileRepository $repository,
        Filesystem $filesystem,
        UploadFileCommand $command
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file-name.pdf');
        $name = new FileName('dummy-file-name.pdf');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);
        $filesystem->has($name)->shouldBeCalled()->willReturn(true);

        $this->shouldThrow(FileException::alreadyExists($name))->during__invoke($command);
    }
}
