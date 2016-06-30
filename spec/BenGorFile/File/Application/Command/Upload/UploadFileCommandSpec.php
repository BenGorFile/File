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
use BenGorFile\File\Domain\Model\UploadedFile;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadFileCommand class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileCommandSpec extends ObjectBehavior
{
    function it_creates_command(UploadedFile $uploadedFile)
    {
        $this->beConstructedWith($uploadedFile, 'dummy-file-name');
        $this->shouldHaveType(UploadFileCommand::class);
        $this->uploadedFile()->shouldReturn($uploadedFile);
        $this->name()->shouldReturn('dummy-file-name');
    }

    function it_creates_command_without_name(UploadedFile $uploadedFile)
    {
        $this->beConstructedWith($uploadedFile);
        $this->uploadedFile()->shouldReturn($uploadedFile);
        $this->name()->shouldReturn(null);
    }
}
