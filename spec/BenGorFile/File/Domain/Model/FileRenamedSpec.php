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

namespace spec\BenGorFile\File\Domain\Model;

use BenGorFile\File\Domain\Model\FileEvent;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileRenamed;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileRenamed domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileRenamedSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new FileId('file-id'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileRenamed::class);
    }

    function it_implements_file_event()
    {
        $this->shouldImplement(FileEvent::class);
    }

    function it_returns_file_id()
    {
        $this->id()->shouldReturnAnInstanceOf(FileId::class);
    }

    function it_returns_occurred_on()
    {
        $this->occurredOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
    }
}
