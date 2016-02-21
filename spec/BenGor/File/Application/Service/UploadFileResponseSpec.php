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

use BenGor\File\Application\Service\UploadFileResponse;
use BenGor\File\Domain\Model\File;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadFileResponse class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UploadFileResponseSpec extends ObjectBehavior
{
    function let(File $file)
    {
        $this->beConstructedWith($file);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UploadFileResponse::class);
    }

    function it_response()
    {
        $this->file()->shouldReturnAnInstanceOf(File::class);
    }
}
