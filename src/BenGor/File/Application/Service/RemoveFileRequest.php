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

/**
 * Remove file request class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class RemoveFileRequest
{
    /**
     * The file name.
     *
     * @var string
     */
    private $name;

    /**
     * The file extension.
     *
     * @var string
     */
    private $extension;

    /**
     * Constructor.
     *
     * @param string $aName       The file name
     * @param string $anExtension The file extension
     */
    public function __construct($aName, $anExtension)
    {
        $this->name = $aName;
        $this->extension = $anExtension;
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
     * Gets the file extension.
     *
     * @return string
     */
    public function extension()
    {
        return $this->extension;
    }
}
