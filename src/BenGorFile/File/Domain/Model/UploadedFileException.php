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

namespace BenGorFile\File\Domain\Model;

/**
 * Exceptions about uploaded file domain object.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class UploadedFileException extends \Exception
{
    /**
     * Uploaded file already exists exception.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return UploadedFileException
     */
    public static function alreadyExists(FileName $aName, FileExtension $anExtension)
    {
        return new static(sprintf(
            'Uploaded file with %s.%s filename is already exists', $aName->name(), $anExtension->extension()
        ));
    }

    /**
     * Uploaded file does not exist exception.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return UploadedFileException
     */
    public static function doesNotExist(FileName $aName, FileExtension $anExtension)
    {
        return new static(sprintf(
            'Uploaded file with %s.%s filename does not exist', $aName->name(), $anExtension->extension()
        ));
    }
}
