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
 * Exceptions about file domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class FileException extends \Exception
{
    /**
     * File does not exist exception.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return FileException
     */
    public static function doesNotExist(FileName $aName, FileExtension $anExtension)
    {
        return new static(sprintf(
            'File with %s.%s filename does not exist', $aName->name(), $anExtension->extension()
        ));
    }
}
