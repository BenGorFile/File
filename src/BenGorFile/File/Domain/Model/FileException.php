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
 * Exceptions about file domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class FileException extends \Exception
{
    /**
     * File does not exist exception.
     *
     * @param FileName $aName The file name
     *
     * @return FileException
     */
    public static function doesNotExist(FileName $aName)
    {
        return new static(sprintf('File with %s filename does not exist', $aName->filename()));
    }

    /**
     * File already exists exception.
     *
     * @param FileName $aName The file name
     *
     * @return FileException
     */
    public static function alreadyExists(FileName $aName)
    {
        return new static(sprintf('File with %s filename is already exists', $aName->filename()));
    }

    /**
     * File id does not exist exception.
     *
     * @param FileId $anId The file id
     *
     * @return FileException
     */
    public static function idDoesNotExist(FileId $anId)
    {
        return new static(sprintf('File with %s id does not exist', $anId->id()));
    }

    /**
     * File id already exists exception.
     *
     * @param FileId $anId The file id
     *
     * @return FileException
     */
    public static function idAlreadyExists(FileId $anId)
    {
        return new static(sprintf('File with %s id is already exists', $anId->id()));
    }
}
