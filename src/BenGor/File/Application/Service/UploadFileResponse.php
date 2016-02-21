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

use BenGor\File\Domain\Model\File;

/**
 * Upload file response class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class UploadFileResponse
{
    /**
     * The file.
     *
     * @var File
     */
    private $file;

    /**
     * Constructor.
     *
     * @param File $aFile The file
     */
    public function __construct(File $aFile)
    {
        $this->file = $aFile;
    }

    /**
     * Gets the file.
     *
     * @return File
     */
    public function file()
    {
        return $this->file;
    }
}
