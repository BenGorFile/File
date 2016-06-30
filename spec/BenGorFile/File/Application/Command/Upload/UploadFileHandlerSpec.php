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
use BenGorFile\File\Domain\Model\FileExtension;
use BenGorFile\File\Domain\Model\FileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;
use BenGorFile\File\Domain\Model\UploadedFileException;
use BenGorFile\File\Infrastructure\UploadedFile\DummyUploadedFile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
        $uploadedFile = new DummyUploadedFile('test-content', 'original-name', 'pdf');
        $command->name()->shouldBeCalled()->willReturn('dummy-file-name');
        $command->uploadedFile()->shouldBeCalled()->willReturn($uploadedFile);
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(false);

        $filesystem->write($name, $extension, 'test-content')->shouldBeCalled();
        $factory->build(Argument::type(FileId::class), $name, $extension)->shouldBeCalled()->willReturn($file);
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_does_not_handle_because_already_exists_an_uploaded_file(
        Filesystem $filesystem,
        UploadFileCommand $command
    ) {
        $uploadedFile = new DummyUploadedFile('test-content', 'original-name', 'pdf');
        $command->name()->shouldBeCalled()->willReturn('dummy-file-name');
        $command->uploadedFile()->shouldBeCalled()->willReturn($uploadedFile);
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(true);

        $this->shouldThrow(UploadedFileException::alreadyExists($name, $extension))->during__invoke($command);
    }
}
