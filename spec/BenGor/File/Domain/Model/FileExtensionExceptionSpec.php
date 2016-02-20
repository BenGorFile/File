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
 * Spec file of FileExtensionException class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileExtensionExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileExtensionException::class);
    }

    function it_extends_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_constructs_does_not_exist()
    {
        $this::doesNotExist(
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(FileExtensionException::class);
    }

    function it_constructs_does_not_support()
    {
        $this::doesNotSupport(
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(FileExtensionException::class);
    }
}
