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

namespace spec\BenGor\File\Infrastructure\Domain\Model;

use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Infrastructure\Domain\Model\FileFactory;
use BenGor\File\Domain\Model\FileFactory as BaseFileFactory;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileFactory domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileFactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(File::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileFactory::class);
    }

    function it_implements_domain_file_factory()
    {
        $this->shouldImplement(BaseFileFactory::class);
    }

    function it_builds_a_file_instance()
    {
        $this->build(
            new FileId('dummy-file-id'),
            new FileName('dummy-file-name'),
            new FileExtension('pdf')
        )->shouldReturnAnInstanceOf(File::class);
    }
}
