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
use BenGorFile\File\Domain\Model\FileMimeTypeException;
use BenGorFile\File\Domain\Model\FileNameException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadFileCommand class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileCommandSpec extends ObjectBehavior
{
    function it_creates_command()
    {
        $this->beConstructedWith('dummy-file-name.pdf', 'pdf-content', 'application/pdf');
        $this->shouldHaveType(UploadFileCommand::class);
        $this->uploadedFile()->shouldReturn('pdf-content');
        $this->name()->shouldReturn('dummy-file-name.pdf');
        $this->mimeType()->shouldReturn('application/pdf');
    }

    function it_does_not_create_a_command_when_file_content_is_null()
    {
        $this->beConstructedWith('dummy-file-name.pdf', null, 'application/pdf');

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    function it_does_not_create_a_command_when_file_name_is_null()
    {
        $this->beConstructedWith(null, 'pdf-content', 'application/pdf');

        $this->shouldThrow(FileNameException::invalidName(null))->duringInstantiation();
    }

    function it_does_not_create_a_command_when_file_mime_type_is_null()
    {
        $this->beConstructedWith('dummy-file-name.pdf', 'pdf-content', null);

        $this->shouldThrow(FileMimeTypeException::doesNotSupport(null))->duringInstantiation();
    }
}
