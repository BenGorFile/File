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

use Ramsey\Uuid\Uuid;

/**
 * File name domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class FileName
{
    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string|null $aName       The name
     * @param string|null $anExtension The extension
     */
    public function __construct($aName = null, $anExtension = null)
    {
        $this->name = null === $aName ? Uuid::uuid4()->toString() : $aName;
        $this->addExtension($anExtension);
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

    /**
     * Method that checks if the name given is equal to the current.
     *
     * @param FileName $aName
     *
     * @return bool
     */
    public function equals(FileName $aName)
    {
        return $this->name() === $aName->name();
    }

    /**
     * Magic method that represents the file name in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }

    /**
     * If extension isn't null, it concatenates to the name.
     *
     * @param string|null $anExtension The extension
     */
    private function addExtension($anExtension = null)
    {
        if (null === $anExtension) {
            return;
        }
        $this->name .= sprintf('.%s', $anExtension);
    }
}
