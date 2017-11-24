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

use BenGorFile\File\Domain\Model\FileName;

/**
 * @author Mikel Etxebarria <mikeletxe4594@gmail.com>
 */
class SqlByNameSpecification implements SqlQuerySpecification
{
    private $name;

    public function __construct(FileName $aName)
    {
        $this->name = $aName;
    }

    public function buildQuery()
    {
        $query = 'SELECT * FROM file f WHERE f.name = :name AND f.extension = :extension';
        $parameters = [":name" => $this->name->name(), ":extension" => $this->name->extension()];

        return [$query, $parameters];
    }
}
