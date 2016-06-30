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
        $this->__toString()->shouldNotBe(null);
    }

    function it_constructs_with_string_name()
    {
        $this->beConstructedWith('test-name');
        $this->name()->shouldReturn('test-name');
        $this->__toString()->shouldReturn('test-name');
    }

    function it_constructs_with_unsanitize_string_name()
    {
        $this->beConstructedWith('the unsanitized file name `?¨');
        $this->name()->shouldReturn('the-unsanitized-file-name');
        $this->__toString()->shouldReturn('the-unsanitized-file-name');
    }

    function it_compares_names()
    {
        $this->beConstructedWith('test-name');

        $this->equals(new FileName('test-name'))->shouldReturn(true);
    }

    function it_compares_different_names()
    {
        $this->beConstructedWith('test-name');
        $this->equals(new FileName('test-name-2'))->shouldReturn(false);
    }
}
