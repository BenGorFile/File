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

namespace spec\BenGorFile\File\Infrastructure\Domain\Model;

use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileExtension;
use BenGorFile\File\Domain\Model\FileFactory as BaseFileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Infrastructure\Domain\Model\FileFactory;
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
