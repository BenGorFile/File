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
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlFilterByNameSpecification implements SqlQuerySpecification, SqlCountSpecification
{
    private $name;
    private $offset;
    private $limit;

    public function __construct($aName, $offset, $limit)
    {
        $this->name = $aName;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function buildQuery()
    {
        $whereClause = !empty($this->name) ? 'WHERE f.name LIKE :name ' : '';
        $limitClause = $this->limit > 0 ? 'LIMIT :limit OFFSET :offset' : '';
        $query = "SELECT * FROM file f $whereClause ORDER BY f.updated_on DESC $limitClause";
        $parameters = [];
        if (!empty($this->name)) {
            $parameters = array_merge([":name" => '%' . $this->name . '%'], $parameters);
        }

        if ($this->limit > 0) {
            $parameters = array_merge([":limit" => $this->limit, ":offset" => $this->offset], $parameters);
        }

        return [$query, $parameters];
    }

    public function buildCount()
    {
        $whereClause = !empty($this->name) ? 'WHERE f.name LIKE :name ' : '';
        $limitClause = $this->limit > 0 ? 'LIMIT :limit OFFSET :offset' : '';
        $query = "SELECT COUNT(*) FROM file f $whereClause ORDER BY f.updated_on DESC $limitClause";
        $parameters = [];
        if (!empty($this->name)) {
            $parameters = array_merge([":name" => '%' . $this->name . '%'], $parameters);
        }

        if ($this->limit > 0) {
            $parameters = array_merge([":limit" => $this->limit, ":offset" => $this->offset], $parameters);
        }

        return [$query, $parameters];
    }
}
