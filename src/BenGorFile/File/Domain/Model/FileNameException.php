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
 * Exceptions about file name domain class.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class FileNameException extends \Exception
{
    /**
     * File name is invalid exception.
     *
     * @param string $aFileName The file name
     *
     * @return FileNameException
     */
    public static function invalidName($aFileName)
    {
        return new static(sprintf('File name with %s is invalid', $aFileName));
    }
}
