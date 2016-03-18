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
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;
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
        $this->beConstructedWith(new FileId('dummy-id'), new FileName('dummy-file-name'), new FileExtension('pdf'));
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

    function it_overwrites()
    {
        $this->name()->shouldReturnAnInstanceOf(FileName::class);
        $this->name()->name()->shouldReturn('dummy-file-name');
        $this->extension()->extension()->shouldReturn('pdf');

        $this->overwrite(
            new FileName('new-dummy-file-name'),
            new FileExtension('png')
        );

        $this->name()->shouldReturnAnInstanceOf(FileName::class);
        $this->name()->name()->shouldReturn('new-dummy-file-name');
        $this->extension()->extension()->shouldReturn('png');
    }

    function it_returns_to_string()
    {
        $this->__toString('dummy-file-name.pdf');
    }
}
