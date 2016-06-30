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
 * Exceptions about file extension domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class FileExtensionException extends \Exception
{
    /**
     * File extension does not exist exception.
     *
     * @param FileExtension $anExtension The file extension
     *
     * @return FileExtensionException
     */
    public static function doesNotExist(FileExtension $anExtension)
    {
        return new static(sprintf('File with %s name does not exist', $anExtension->extension()));
    }

    /**
     * File extension does not support exception.
     *
     * @param FileExtension $anExtension The file extension
     *
     * @return FileExtensionException
     */
    public static function doesNotSupport(FileExtension $anExtension)
    {
        return new static(sprintf('File with %s name does not support', $anExtension->extension()));
    }
}
