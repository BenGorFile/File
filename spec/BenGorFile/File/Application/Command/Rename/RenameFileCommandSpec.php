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

namespace spec\BenGorFile\File\Application\Command\Rename;

use BenGorFile\File\Application\Command\Rename\RenameFileCommand;
use BenGorFile\File\Domain\Model\FileNameInvalidException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of RenameFileCommand class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RenameFileCommandSpec extends ObjectBehavior
{
    function it_creates_command()
    {
        $this->beConstructedWith('file-id', 'dummy-file-name.pdf');
        $this->shouldHaveType(RenameFileCommand::class);
        $this->id()->shouldReturn('file-id');
        $this->name()->shouldReturn('dummy-file-name.pdf');
    }

    function it_does_not_create_a_command_when_file_id_is_null()
    {
        $this->beConstructedWith(null, 'dummy-file-name.pdf', 'pdf-content', 'application/pdf');

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    function it_does_not_create_a_command_when_file_name_is_null()
    {
        $this->beConstructedWith('file-id', null, 'pdf-content', 'application/pdf');

        $this->shouldThrow(FileNameInvalidException::class)->duringInstantiation();
    }
}
