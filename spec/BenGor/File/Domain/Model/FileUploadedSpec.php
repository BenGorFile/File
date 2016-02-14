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

namespace spec\BenGor\File\Domain\Model;

use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileUploaded;
use Ddd\Domain\DomainEvent;
use Ddd\Domain\Event\PublishableDomainEvent;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileUploaded domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileUploadedSpec extends ObjectBehavior
{
    function let(File $file)
    {
        $this->beConstructedWith($file);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileUploaded::class);
    }

    function it_implements_domain_event_and_publishable_domain_event()
    {
        $this->shouldImplement(DomainEvent::class);
        $this->shouldImplement(PublishableDomainEvent::class);
    }

    function it_returns_file()
    {
        $this->file()->shouldReturnAnInstanceOf(File::class);
    }

    function it_returns_occurred_on()
    {
        $this->occurredOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
    }
}
