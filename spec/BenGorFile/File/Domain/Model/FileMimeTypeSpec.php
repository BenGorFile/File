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

use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileMimeTypeException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileMimeType value object class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileMimeTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('application/pdf');
        $this->shouldHaveType(FileMimeType::class);
    }

    function it_constructs_with_not_supported_mime_type()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(FileMimeTypeException::doesNotSupport(null))->duringInstantiation();
    }

    function it_constructs_with_valid_mime_type()
    {
        $this->beConstructedWith('application/pdf');
        $this->mimeType()->shouldReturn('application/pdf');
        $this->__toString()->shouldReturn('application/pdf');
    }

    function it_compares_mime_types()
    {
        $this->beConstructedWith('application/pdf');

        $this->equals(new FileMimeType('application/pdf'))->shouldReturn(true);
    }

    function it_compares_different_mime_types()
    {
        $this->beConstructedWith('application/pdf');
        $this->equals(new FileMimeType('application/x-7z-compressed'))->shouldReturn(false);
    }
}
