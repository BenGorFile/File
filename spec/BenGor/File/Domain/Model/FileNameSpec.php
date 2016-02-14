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

use BenGor\File\Domain\Model\FileName;
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
        $this->shouldHaveType(FileName::class);
    }

    function it_constructs_with_null_name()
    {
        $this->name()->shouldNotBe(null);
    }

    function it_constructs_with_string_name_and_null_extension()
    {
        $this->beConstructedWith('test-name');
        $this->name()->shouldReturn('test-name');
    }

    function it_constructs_with_string_name_and_string_extension()
    {
        $this->beConstructedWith('test-name', 'pdf');
        $this->name()->shouldReturn('test-name.pdf');
    }

    function it_compares_names()
    {
        $this->beConstructedWith('test-name', 'pdf');

        $this->equals(new FileName('test-name', 'pdf'))->shouldReturn(true);
    }

    function it_compares_different_ids()
    {
        $this->beConstructedWith('test-name');
        $this->equals(new FileName('test-name', 'pdf'))->shouldReturn(false);
    }

    function it_renders_string()
    {
        $this->beConstructedWith('test-name', 'pdf');

        $this->__toString()->shouldReturn('test-name.pdf');
    }
}
