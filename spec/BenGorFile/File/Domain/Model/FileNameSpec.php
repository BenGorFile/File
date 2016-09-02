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

use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileNameInvalidException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileName value object class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('test-name.pdf');
        $this->shouldHaveType(FileName::class);
    }

    function it_constructs_with_null_name()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(FileNameInvalidException::class)->duringInstantiation();
    }

    function it_constructs_with_string_name()
    {
        $this->beConstructedWith('test-name.pdf');
        $this->name()->shouldReturn('test-name');
        $this->extension()->shouldReturn('pdf');
        $this->filename()->shouldReturn('test-name.pdf');
        $this->__toString()->shouldReturn('test-name.pdf');
    }

    function it_constructs_with_unsanitize_string_name()
    {
        $this->beConstructedWith('the unsanitized file name `?¨.pdf');
        $this->name()->shouldReturn('the-unsanitized-file-name');
        $this->extension()->shouldReturn('pdf');
        $this->filename()->shouldReturn('the-unsanitized-file-name.pdf');
        $this->__toString()->shouldReturn('the-unsanitized-file-name.pdf');
    }

    function it_compares_names()
    {
        $this->beConstructedWith('test-name.pdf');

        $this->equals(new FileName('test-name.pdf'))->shouldReturn(true);
    }

    function it_compares_different_names()
    {
        $this->beConstructedWith('test-name.pdf');
        $this->equals(new FileName('test-name-2.pdf'))->shouldReturn(false);
    }
}
