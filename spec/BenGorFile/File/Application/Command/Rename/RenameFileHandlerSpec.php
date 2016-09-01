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

namespace spec\BenGorFile\File\Application\Command\Rename;

use BenGorFile\File\Application\Command\Rename\RenameFileCommand;
use BenGorFile\File\Application\Command\Rename\RenameFileHandler;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of RenameFileHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RenameFileHandlerSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository)
    {
        $this->beConstructedWith($filesystem, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RenameFileHandler::class);
    }

    function it_renames(
        RenameFileCommand $command,
        FileRepository $repository,
        File $file,
        Filesystem $filesystem
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file.pdf');
        $id = new FileId('file-id');
        $name = new FileName('dummy-file.pdf');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn($file);
        $oldName = new FileName('old-file-name.pdf');
        $file->name()->shouldBeCalled()->willReturn($oldName);
        $filesystem->rename($oldName, $name)->shouldBeCalled();
        $file->rename($name)->shouldBeCalled();
        $repository->persist($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_does_not_rename_because_id_does_not_exist(RenameFileCommand $command, FileRepository $repository)
    {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $command->name()->shouldBeCalled()->willReturn('dummy-file.pdf');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileException::idDoesNotExist($id))->during__invoke($command);
    }
}
