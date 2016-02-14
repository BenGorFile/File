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
use BenGor\File\Domain\Model\UploadedFile;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of OverwriteFileRequest class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class OverwriteFileRequestSpec extends ObjectBehavior
{
    function let(UploadedFile $uploadedFile)
    {
        $this->beConstructedWith($uploadedFile, 'dummy-file-name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OverwriteFileRequest::class);
    }

    function it_request()
    {
        $this->uploadedFile()->shouldReturnAnInstanceOf(UploadedFile::class);
        $this->name()->shouldReturn('dummy-file-name');
    }
}
