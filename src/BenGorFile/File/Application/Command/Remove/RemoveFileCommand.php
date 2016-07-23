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

namespace BenGorFile\File\Application\Command\Remove;

/**
 * Remove file command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class RemoveFileCommand
{
    /**
     * The file id.
     *
     * @var string
     */
    private $id;

    /**
     * Constructor.
     *
     * @param string $anId The file id
     *
     * @throws \InvalidArgumentException when the id given is null
     */
    public function __construct($anId)
    {
        if (null === $anId) {
            throw new \InvalidArgumentException('The file id cannot be null');
        }
        $this->id = $anId;
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
}
