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
use PhpSpec\ObjectBehavior;

/**
 * Spec file of RemoveFileRequest class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemoveFileRequestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('dummy-file-name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveFileRequest::class);
    }

    function it_request()
    {
        $this->name()->shouldReturn('dummy-file-name');
    }
}
