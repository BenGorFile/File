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

use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of File domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileSpec extends ObjectBehavior
{
    function it_constructs()
    {
        $this->beConstructedWith(
            new FileId('dummy-id'),
            new FileName('dummy-file-name.pdf'),
            new FileMimeType('application/pdf')
        );
        $this->shouldHaveType(File::class);
        $this->id()->shouldReturnAnInstanceOf(FileId::class);
        $this->id()->id()->shouldReturn('dummy-id');
        $this->name()->shouldReturnAnInstanceOf(FileName::class);
        $this->name()->filename()->shouldReturn('dummy-file-name.pdf');
        $this->mimeType()->shouldReturnAnInstanceOf(FileMimeType::class);
        $this->mimeType()->mimeType()->shouldReturn('application/pdf');
        $this->createdOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
        $this->updatedOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
        $this->__toString('dummy-file-name.pdf');

        $this->events()->shouldHaveCount(1);
        $this->eraseEvents();
        $this->events()->shouldHaveCount(0);
    }

    function it_overwrites()
    {
        $this->beConstructedWith(
            new FileId('dummy-id'),
            new FileName('dummy-file-name.pdf'),
            new FileMimeType('application/pdf')
        );
        $this->name()->filename()->shouldReturn('dummy-file-name.pdf');
        $this->mimeType()->mimeType()->shouldReturn('application/pdf');
        $this->events()->shouldHaveCount(1);

        $this->overwrite(new FileName('other-file.png'), new FileMimeType('image/png'));

        $this->name()->filename()->shouldReturn('other-file.png');
        $this->mimeType()->mimeType()->shouldReturn('image/png');
        $this->events()->shouldHaveCount(2);
    }

    function it_removes()
    {
        $this->beConstructedWith(
            new FileId('dummy-id'),
            new FileName('dummy-file-name.pdf'),
            new FileMimeType('application/pdf')
        );
        $this->events()->shouldHaveCount(1);

        $this->remove();
        $this->events()->shouldHaveCount(2);
    }
}
