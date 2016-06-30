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

use BenGorFile\File\Domain\Model\UploadedFile;

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
     * The uploaded file.
     *
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * Constructor.
     *
     * @param UploadedFile $anUploadedFile The uploaded file
     * @param string       $aName          The file name
     */
    public function __construct(UploadedFile $anUploadedFile, $aName = null)
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
