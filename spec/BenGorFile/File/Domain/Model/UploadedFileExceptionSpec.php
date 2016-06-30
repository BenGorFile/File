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

use BenGorFile\File\Domain\Model\FileExtension;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\UploadedFileException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of UploadedFileException class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UploadedFileExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UploadedFileException::class);
    }

    function it_extends_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_constructs_already_exists()
    {
        $this::alreadyExists(
            new FileName('dummy-file-name'),
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(UploadedFileException::class);
    }

    function it_constructs_does_not_exist()
    {
        $this::doesNotExist(
            new FileName('dummy-file-name'),
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(UploadedFileException::class);
    }
}
