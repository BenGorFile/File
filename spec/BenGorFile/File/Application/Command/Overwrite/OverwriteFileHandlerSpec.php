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

namespace spec\BenGorFile\File\Application\Command\Overwrite;

use BenGorFile\File\Application\Command\Overwrite\OverwriteFileCommand;
use BenGorFile\File\Application\Command\Overwrite\OverwriteFileHandler;
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
 * Spec file of OverwriteFileHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class OverwriteFileHandlerSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository, FileFactory $factory)
    {
        $this->beConstructedWith($filesystem, $repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OverwriteFileHandler::class);
    }

    function it_overwrites(
        OverwriteFileCommand $command,
        FileRepository $repository,
        File $file,
        Filesystem $filesystem
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file.pdf');
        $command->mimeType()->shouldBeCalled()->willReturn('application/pdf');
        $command->uploadedFile()->shouldBeCalled()->willReturn('file content');
        $id = new FileId('file-id');
        $name = new FileName('dummy-file.pdf');
        $mimeType = new FileMimeType('application/pdf');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn($file);
        $oldName = new FileName('old-file-name.pdf');
        $file->name()->shouldBeCalled()->willReturn($oldName);
        $filesystem->delete($oldName)->shouldBeCalled();
        $file->overwrite($name, $mimeType)->shouldBeCalled();
        $filesystem->write($name, 'file content')->shouldBeCalled();
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_does_not_overwrite_because_id_does_not_exist(OverwriteFileCommand $command, FileRepository $repository)
    {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file.pdf');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileException::idDoesNotExist($id))->during__invoke($command);
    }
}
