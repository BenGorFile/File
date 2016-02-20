<?php

/*
 * This file is part of the BenGorFile library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\BenGor\File\Application\Service;

use BenGor\File\Application\Service\RemoveFileRequest;
use BenGor\File\Application\Service\RemoveFileService;
use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileException;
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use BenGor\File\Domain\Model\Filesystem;
use BenGor\File\Domain\Model\UploadedFileException;
use Ddd\Application\Service\ApplicationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of RemoveFileService class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemoveFileServiceSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository)
    {
        $this->beConstructedWith($filesystem, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveFileService::class);
    }

    function it_implements_application_service()
    {
        $this->shouldImplement(ApplicationService::class);
    }

    function it_executes(Filesystem $filesystem, FileRepository $repository, File $file)
    {
        $request = new RemoveFileRequest('dummy-file-name', 'pdf');
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(true);
        $repository->fileOfName($name, $extension)->shouldBeCalled()->willReturn($file);
        $filesystem->delete($name, $extension)->shouldBeCalled();
        $file->remove()->shouldBeCalled();

        $repository->remove(Argument::type(File::class))->shouldBeCalled();

        $this->execute($request);
    }

    function it_does_not_execute_because_uploaded_file_does_not_exist(Filesystem $filesystem)
    {
        $request = new RemoveFileRequest('dummy-file-name', 'pdf');
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(false);

        $this->shouldThrow(UploadedFileException::doesNotExist($name, $extension))->duringExecute($request);
    }

    function it_does_not_execute_because_file_does_not_exist(Filesystem $filesystem, FileRepository $repository)
    {
        $request = new RemoveFileRequest('dummy-file-name', 'pdf');
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(true);
        $repository->fileOfName($name, $extension)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileException::doesNotExist($name, $extension))->duringExecute($request);
    }
}
