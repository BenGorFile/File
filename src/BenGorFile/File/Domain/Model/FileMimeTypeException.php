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
 * Exceptions about file mime type domain class.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class FileMimeTypeException extends \Exception
{
    /**
     * File extension does not support exception.
     *
     * @param string $aMimeType The file mime type in string
     *
     * @return FileMimeTypeException
     */
    public static function doesNotSupport($aMimeType)
    {
        return new static(sprintf('File with %s mime type is not supported', $aMimeType));
    }
}
