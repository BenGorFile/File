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

namespace BenGorFile\File\Infrastructure\Persistence\Sql;

/**
 * @author Mikel Etxebarria <mikeletxe4594@gmail.com>
 */
interface SqlQuerySpecification
{
    public function buildQuery();
}
