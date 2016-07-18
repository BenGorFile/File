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

namespace BenGorFile\File\Application\DataTransformer;

/**
 * File data transformer.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface FileDataTransformer
{
    /**
     * Writes the high level user domain concepts.
     *
     * @param mixed $aFile The user, it can be domain user or just a DTO
     */
    public function write($aFile);

    /**
     * Reads the low level user infrastructure details.
     *
     * @return mixed
     */
    public function read();
}
