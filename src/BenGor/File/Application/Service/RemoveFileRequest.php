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
     * Constructor.
     *
     * @param string $aName The file name
     */
    public function __construct($aName)
    {
        $this->name = $aName;
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
}
