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
use BenGor\File\Application\Service\UploadFileService;
use BenGor\File\Domain\Exception\UploadedFileAlreadyExistsException;
use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use BenGor\File\Domain\Model\Filesystem;
use BenGor\File\Domain\Model\UploadedFileException;
use BenGor\File\Infrastructure\UploadedFile\Test\DummyUploadedFile;
use Ddd\Application\Service\ApplicationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of UploadFileService class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileServiceSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileRepository $repository)
    {
        $this->beConstructedWith($filesystem, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UploadFileService::class);
    }

    function it_implements_application_service()
    {
        $this->shouldImplement(ApplicationService::class);
    }

    function it_executes(Filesystem $filesystem, FileRepository $repository)
    {
        $request = new UploadFileRequest(new DummyUploadedFile('test-content', 'pdf'), 'dummy-file-name');
        $name = new FileName('dummy-file-name', 'pdf');

        $filesystem->has($name)->shouldBeCalled()->willReturn(false);

        $filesystem->write($name, 'test-content')->shouldBeCalled();
        $repository->nextIdentity()->shouldBeCalled()->willReturn(new FileId('dummy-id'));
        $repository->persist(Argument::type(File::class))->shouldBeCalled();

        $this->execute($request);
    }

    function it_does_not_execute_because_already_exists_an_uploaded_file(Filesystem $filesystem)
    {
        $request = new UploadFileRequest(new DummyUploadedFile('test-content', 'pdf'), 'dummy-file-name');
        $name = new FileName('dummy-file-name', 'pdf');

        $filesystem->has($name)->shouldBeCalled()->willReturn(true);

        $this->shouldThrow(UploadedFileException::alreadyExists($name))->duringExecute($request);
    }
}
