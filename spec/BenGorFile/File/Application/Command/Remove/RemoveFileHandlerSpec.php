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

namespace spec\BenGorFile\File\Application\Command\Remove;

use BenGorFile\File\Application\Command\Remove\RemoveFileCommand;
use BenGorFile\File\Application\Command\Remove\RemoveFileHandler;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileDoesNotExistException;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileRepository;
use BenGorFile\File\Domain\Model\Filesystem;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of RemoveFileHandler class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RemoveFileHandlerSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository)
    {
        $this->beConstructedWith($filesystem, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveFileHandler::class);
    }

    function it_handles(
        RemoveFileCommand $command,
        Filesystem $filesystem,
        FileRepository $repository,
        File $file
    ) {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $name = new FileName('file.pdf');

        $repository->fileOfId($id)->shouldBeCalled()->willReturn($file);
        $file->name()->shouldBeCalled()->willReturn($name);

        $filesystem->delete($name)->shouldBeCalled();
        $repository->remove($file)->shouldBeCalled();

        $this->__invoke($command);
    }

    function it_does_not_handle_because_file_id_does_not_exist(FileRepository $repository, RemoveFileCommand $command)
    {
        $command->id()->shouldBeCalled()->willReturn('file-id');
        $id = new FileId('file-id');
        $repository->fileOfId($id)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileDoesNotExistException::class)->during__invoke($command);
    }
}
