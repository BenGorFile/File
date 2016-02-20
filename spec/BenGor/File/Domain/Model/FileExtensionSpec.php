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

use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileExtensionException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileExtension value object class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileExtensionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('pdf');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileExtension::class);
    }

    function it_constructs_with_a_valid_extension()
    {
        $this->extension()->shouldReturn('pdf');
        $this->__toString()->shouldReturn('pdf');
    }

    function it_constructs_with_an_invalid_extension()
    {
        $this->beConstructedWith('non-exist-mime-type');

        $this->shouldThrow(FileExtensionException::class)->duringInstantiation('non-exist-mime-type');
    }

    function it_compares_extensions()
    {
        $this->equals(new FileExtension('pdf'))->shouldReturn(true);
    }

    function it_compares_different_extensions()
    {
        $this->equals(new FileExtension('png'))->shouldReturn(false);
    }
}
