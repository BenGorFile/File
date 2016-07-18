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
 * File of id query.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfIdQuery
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
     */
    public function __construct($anId)
    {
        if (null === $anId) {
            throw new \InvalidArgumentException('Id cannot be null');
        }
        $this->id = $anId;
    }

    /**
     * Gets the id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }
}
