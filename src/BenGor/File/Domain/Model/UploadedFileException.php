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

namespace BenGor\File\Domain\Model;

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
     * @param FileName $aName The file name
     *
     * @return UploadedFileException
     */
    public static function alreadyExists(FileName $aName)
    {
        return new static(sprintf('Uploaded file with %s name is already exists', $aName->name()));
    }

    /**
     * Uploaded file does not exist exception.
     *
     * @param FileName $aName The file name
     *
     * @return UploadedFileException
     */
    public static function doesNotExist(FileName $aName)
    {
        return new static(sprintf('Uploaded file with %s name does not exist', $aName->name()));
    }
}
