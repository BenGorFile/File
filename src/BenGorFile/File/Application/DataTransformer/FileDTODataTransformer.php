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

namespace BenGorFile\File\Application\DataTransformer;

use BenGorFile\File\Domain\Model\File;

/**
 * File DTO data transformer.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileDTODataTransformer implements FileDataTransformer
{
    /**
     * The domain file.
     *
     * @var File
     */
    protected $file;

    /**
     * {@inheritdoc}
     */
    public function write($aFile)
    {
        if (!$aFile instanceof File) {
            throw new \InvalidArgumentException(sprintf('Expected instance of %s', File::class));
        }
        $this->file = $aFile;
    }

    /**
     * {@inheritdoc}
     */
    public function read()
    {
        if (null === $this->file) {
            return [];
        }

        return [
            'id'         => $this->file->id()->id(),
            'created_on' => $this->file->createdOn(),
            'mime_type'  => $this->file->mimeType()->mimeType(),
            'file_name'  => $this->file->name()->filename(),
            'updated_on' => $this->file->updatedOn(),
        ];
    }
}
