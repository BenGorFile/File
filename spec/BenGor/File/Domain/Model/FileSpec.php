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
use BenGor\File\Domain\Model\FileId;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of File domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new FileId('dummy-id'), 'dummy-file');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(File::class);
    }

    function it_returns_id()
    {
        $this->id()->shouldReturnAnInstanceOf(FileId::class);
        $this->id()->id()->shouldReturn('dummy-id');
    }

    function it_returns_created_on_and_updated_on()
    {
        $this->createdOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
        $this->updatedOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
    }

    function it_updates()
    {
        $this->name()->shouldReturn('dummy-file');

        $this->update('new-dummy-file');

        $this->name()->shouldReturn('new-dummy-file');
    }
}
