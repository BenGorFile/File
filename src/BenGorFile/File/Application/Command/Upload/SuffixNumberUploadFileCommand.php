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

namespace BenGorFile\File\Application\Command\Upload;

use BenGorFile\File\Domain\Model\FileMimeTypeDoesNotSupportException;
use BenGorFile\File\Domain\Model\FileNameInvalidException;
use Ramsey\Uuid\Uuid;

/**
 * Upload with suffix number file command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class SuffixNumberUploadFileCommand
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
     * @param string      $aName          The file name
     * @param mixed       $anUploadedFile The real content of file
     * @param string      $aMimeType      The file mime type
     * @param string|null $anId           The file id
     *
     * @throws FileNameInvalidException            when the mime type given is null
     * @throws FileMimeTypeDoesNotSupportException when the name given is null
     */
    public function __construct($aName, $anUploadedFile, $aMimeType, $anId = null)
    {
        if (null === $aName) {
            throw new FileNameInvalidException();
        }
        if (null === $anUploadedFile) {
            throw new \InvalidArgumentException('The file content cannot be null');
        }
        if (null === $aMimeType) {
            throw new FileMimeTypeDoesNotSupportException();
        }
        $this->id = null === $anId ? Uuid::uuid4()->toString() : $anId;
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
