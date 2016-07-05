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

use BenGorFile\File\Domain\Model\FileMimeTypeException;
use BenGorFile\File\Domain\Model\FileNameException;

/**
 * Upload file command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UploadFileCommand
{
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
     * @param string $aName          The file name
     * @param mixed  $anUploadedFile The real content of file
     * @param string $aMimeType      The file mime type
     *
     * @throws \InvalidArgumentException when the file content is null
     * @throws FileMimeTypeException     when the mime type given is null
     * @throws FileNameException         when the name given is null
     */
    public function __construct($aName, $anUploadedFile, $aMimeType)
    {
        if (null === $aName) {
            throw FileNameException::invalidName($aName);
        }
        if (null === $anUploadedFile) {
            throw new \InvalidArgumentException('The file content cannot be null');
        }
        if (null === $aMimeType) {
            throw FileMimeTypeException::doesNotSupport($aMimeType);
        }
        $this->name = $aName;
        $this->uploadedFile = $anUploadedFile;
        $this->mimeType = $aMimeType;
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
