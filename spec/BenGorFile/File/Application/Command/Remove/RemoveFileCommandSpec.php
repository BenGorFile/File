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
use PhpSpec\ObjectBehavior;

/**
 * Spec file of OverwriteFileCommand class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemoveFileCommandSpec extends ObjectBehavior
{
    function it_creates_command()
    {
        $this->beConstructedWith('file-id');
        $this->shouldHaveType(RemoveFileCommand::class);
        $this->id()->shouldReturn('file-id');
    }

    function it_does_not_create_a_command_when_file_id_is_null()
    {
        $this->beConstructedWith(null);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }
}
