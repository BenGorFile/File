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

use BenGor\File\Application\Service\UploadFileRequest;
use BenGor\File\Application\Service\UploadFileResponse;
use BenGor\File\Application\Service\UploadFileService;
use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileFactory;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use BenGor\File\Domain\Model\Filesystem;
use BenGor\File\Domain\Model\UploadedFileException;
use BenGor\File\Infrastructure\UploadedFile\Test\DummyUploadedFile;
use Ddd\Application\Service\ApplicationService;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadFileService class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileServiceSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository, FileFactory $factory)
    {
        $this->beConstructedWith($filesystem, $repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UploadFileService::class);
    }

    function it_implements_application_service()
    {
        $this->shouldImplement(ApplicationService::class);
    }

    function it_executes(Filesystem $filesystem, FileRepository $repository, FileFactory $factory, File $file)
    {
        $request = new UploadFileRequest(
            new DummyUploadedFile('test-content', 'original-name', 'pdf'),
            'dummy-file-name'
        );
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');
        $id = new FileId('dummy-id');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(false);

        $filesystem->write($name, $extension, 'test-content')->shouldBeCalled();
        $repository->nextIdentity()->shouldBeCalled()->willReturn($id);
        $factory->build($id, $name, $extension)->shouldBeCalled()->willReturn($file);
        $repository->persist($file)->shouldBeCalled();

        $this->execute($request)->shouldReturnAnInstanceOf(UploadFileResponse::class);
    }

    function it_does_not_execute_because_already_exists_an_uploaded_file(Filesystem $filesystem)
    {
        $request = new UploadFileRequest(
            new DummyUploadedFile('test-content', 'original-name', 'pdf'),
            'dummy-file-name'
        );
        $name = new FileName('dummy-file-name');
        $extension = new FileExtension('pdf');

        $filesystem->has($name, $extension)->shouldBeCalled()->willReturn(true);

        $this->shouldThrow(UploadedFileException::alreadyExists($name, $extension))->duringExecute($request);
    }
}
