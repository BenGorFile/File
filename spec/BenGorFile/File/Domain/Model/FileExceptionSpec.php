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

use BenGorFile\File\Domain\Model\FileException;
use BenGorFile\File\Domain\Model\FileExtension;
use BenGorFile\File\Domain\Model\FileName;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileException class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileException::class);
    }

    function it_extends_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_constructs_does_not_exist()
    {
        $this::doesNotExist(
            new FileName('dummy-file-name'),
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(FileException::class);
    }
}
