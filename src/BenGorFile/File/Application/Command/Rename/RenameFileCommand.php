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

namespace BenGorFile\File\Application\Command\Rename;

use BenGorFile\File\Domain\Model\FileNameInvalidException;

/**
 * Rename file command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RenameFileCommand
{
    /**
     * The file id.
     *
     * @var string
     */
    private $id;

    /**
     * The file name.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string $anId  The file id
     * @param string $aName The file name
     *
     * @throws \InvalidArgumentException when the id or uploaded file given are null
     * @throws FileNameInvalidException  when the name given is null
     */
    public function __construct($anId, $aName)
    {
        if (null === $anId) {
            throw new \InvalidArgumentException('The file id cannot be null');
        }
        if (null === $aName) {
            throw new FileNameInvalidException();
        }
        $this->id = $anId;
        $this->name = $aName;
    }

    /**
     * Gets the file id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
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
