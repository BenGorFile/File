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

namespace spec\BenGorFile\File\Application\DataTransformer;

use BenGorFile\File\Application\DataTransformer\FileDataTransformer;
use BenGorFile\File\Application\DataTransformer\FileDTODataTransformer;
use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileDTODataTransformer class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileDTODataTransformerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileDTODataTransformer::class);
    }

    function it_implements_file_data_transformer()
    {
        $this->shouldImplement(FileDataTransformer::class);
    }

    function it_transform_without_file_domain_class()
    {
        $this->read()->shouldReturn([]);

        $this->shouldThrow(
            new \InvalidArgumentException(sprintf('Expected instance of %s', File::class))
        )->duringWrite(['id' => 'not-file-domain-model-class']);
    }

    function it_transforms(File $file, \DateTimeImmutable $createdOn, \DateTimeImmutable $updatedOn)
    {
        $this->read()->shouldReturn([]);

        $this->write($file);

        $file->id()->shouldBeCalled()->willReturn(new FileId('file-id'));
        $file->createdOn()->shouldBeCalled()->willReturn($createdOn);
        $file->mimeType()->shouldBeCalled()->willReturn(new FileMimeType('image/jpeg'));
        $file->name()->shouldBeCalled()->willReturn(new FileName('image.jpeg'));
        $file->updatedOn()->shouldBeCalled()->willReturn($updatedOn);

        $this->read()->shouldReturn([
            'id'         => 'file-id',
            'created_on' => $createdOn,
            'mime_type'  => 'image/jpeg',
            'file_name'  => 'image.jpeg',
            'name'       => 'image',
            'extension'  => 'jpeg',
            'updated_on' => $updatedOn,
        ]);
    }
}
