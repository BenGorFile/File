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
use BenGorFile\File\Domain\Model\FileExtension;
use BenGorFile\File\Domain\Model\FileId;
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
    function it_uploads()
    {
        $this->beConstructedWith(new FileId('dummy-id'), new FileName('dummy-file-name'), new FileExtension('pdf'));
        $this->shouldHaveType(File::class);
        $this->id()->shouldReturnAnInstanceOf(FileId::class);
        $this->id()->id()->shouldReturn('dummy-id');
        $this->createdOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
        $this->updatedOn()->shouldReturnAnInstanceOf(\DateTimeImmutable::class);
        $this->__toString('dummy-file-name.pdf');

        $this->events()->shouldHaveCount(1);
        $this->eraseEvents();
        $this->events()->shouldHaveCount(0);
    }
}
