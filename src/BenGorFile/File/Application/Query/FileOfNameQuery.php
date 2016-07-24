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

namespace BenGorFile\File\Application\Query;

/**
 * File of name query.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfNameQuery
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
        if (null === $aName) {
            throw new \InvalidArgumentException('Name cannot be null');
        }
        $this->name = $aName;
    }

    /**
     * Gets the name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
