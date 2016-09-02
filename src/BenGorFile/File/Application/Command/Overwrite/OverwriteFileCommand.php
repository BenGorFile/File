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

namespace BenGorFile\File\Application\Command\Overwrite;

use BenGorFile\File\Domain\Model\FileMimeTypeDoesNotSupportException;
use BenGorFile\File\Domain\Model\FileNameInvalidException;

/**
 * Overwrite file command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class OverwriteFileCommand
{
    /**
     * The file id.
     *
     * @var string
     */
    private $id;

    /**
     * The file name.
     *
     * @var string
     */
    private $name;

    /**
     * The real content of file.
     *
     * @var mixed
     */
    private $uploadedFile;

    /**
     * The file mime type.
     *
     * @var string
     */
    private $mimeType;

    /**
     * Constructor.
     *
     * @param string $anId           The file id
     * @param string $aName          The file name
     * @param mixed  $anUploadedFile The real content of file
     * @param string $aMimeType      The file mime type
     *
     * @throws \InvalidArgumentException           when the id or uploaded file given are null
     * @throws FileNameInvalidException            when the mime type given is null
     * @throws FileMimeTypeDoesNotSupportException when the name given is null
     */
    public function __construct($anId, $aName, $anUploadedFile, $aMimeType)
    {
        if (null === $anId) {
            throw new \InvalidArgumentException('The file id cannot be null');
        }
        if (null === $aName) {
            throw new FileNameInvalidException();
        }
        if (null === $anUploadedFile) {
            throw new \InvalidArgumentException('The file content cannot be null');
        }
        if (null === $aMimeType) {
            throw new FileMimeTypeDoesNotSupportException();
        }
        $this->id = $anId;
        $this->name = $aName;
        $this->uploadedFile = $anUploadedFile;
        $this->mimeType = $aMimeType;
    }

    /**
     * Gets the file id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Gets the file name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Gets the mime type.
     *
     * @return string
     */
    public function mimeType()
    {
        return $this->mimeType;
    }

    /**
     * Gets the real content of file.
     *
     * @return mixed
     */
    public function uploadedFile()
    {
        return $this->uploadedFile;
    }
}
