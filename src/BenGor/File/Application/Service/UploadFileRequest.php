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

namespace BenGor\File\Application\Service;

use BenGor\File\Domain\Model\UploadedFile;

/**
 * Upload file request class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class UploadFileRequest
{
    /**
     * The file name.
     *
     * @var string
     */
    private $name;

    /**
     * The uploaded file.
     *
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * Constructor.
     *
     * @param string       $aName          The file name
     * @param UploadedFile $anUploadedFile The uploaded file
     */
    public function __construct($aName, UploadedFile $anUploadedFile)
    {
        $this->name = $aName;
        $this->uploadedFile = $anUploadedFile;
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
     * Gets the uploaded file.
     *
     * @return UploadedFile
     */
    public function uploadedFile()
    {
        return $this->uploadedFile;
    }
}
