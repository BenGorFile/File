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

namespace BenGorFile\File\Infrastructure\Application;

/**
 * File query bus class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface FileQueryBus
{
    /**
     * Executes the given query.
     *
     * @param mixed $query  The query given
     * @param mixed $result The result reference
     */
    public function handle($query, &$result);
}
