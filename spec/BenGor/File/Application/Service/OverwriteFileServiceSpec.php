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

use BenGor\File\Application\Service\OverwriteFileRequest;
use BenGor\File\Application\Service\OverwriteFileService;
use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileException;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use BenGor\File\Domain\Model\Filesystem;
use BenGor\File\Domain\Model\UploadedFileException;
use BenGor\File\Infrastructure\UploadedFile\Test\DummyUploadedFile;
use Ddd\Application\Service\ApplicationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of OverwriteFileService class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class OverwriteFileServiceSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository)
    {
        $this->beConstructedWith($filesystem, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OverwriteFileService::class);
    }

    function it_implements_application_service()
    {
        $this->shouldImplement(ApplicationService::class);
    }

    function it_executes(Filesystem $filesystem, FileRepository $repository, File $file)
    {
        $request = new OverwriteFileRequest(new DummyUploadedFile('test-content', 'pdf'), 'dummy-file-name');
        $name = new FileName('dummy-file-name', 'pdf');

        $filesystem->has($name)->shouldBeCalled()->willReturn(true);
        $repository->fileOfName($name)->shouldBeCalled()->willReturn($file);
        $filesystem->overwrite($name, 'test-content')->shouldBeCalled();
        $file->overwrite($name)->shouldBeCalled();

        $repository->persist(Argument::type(File::class))->shouldBeCalled();

        $this->execute($request);
    }

    function it_does_not_execute_because_uploaded_file_does_not_exist(Filesystem $filesystem)
    {
        $request = new OverwriteFileRequest(new DummyUploadedFile('test-content', 'pdf'), 'dummy-file-name');
        $name = new FileName('dummy-file-name', 'pdf');

        $filesystem->has($name)->shouldBeCalled()->willReturn(false);

        $this->shouldThrow(UploadedFileException::doesNotExist($name))->duringExecute($request);
    }

    function it_does_not_execute_because_file_does_not_exist(Filesystem $filesystem, FileRepository $repository)
    {
        $request = new OverwriteFileRequest(new DummyUploadedFile('test-content', 'pdf'), 'dummy-file-name');
        $name = new FileName('dummy-file-name', 'pdf');

        $filesystem->has($name)->shouldBeCalled()->willReturn(true);
        $repository->fileOfName($name)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(FileException::doesNotExist($name))->duringExecute($request);
    }
}
