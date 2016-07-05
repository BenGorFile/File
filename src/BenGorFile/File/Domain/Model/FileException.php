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
        return new static(sprintf('File with %s filename is alredy exists', $aName->filename()));
    }
}
