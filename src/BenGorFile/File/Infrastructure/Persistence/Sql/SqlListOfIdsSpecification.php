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
class SqlListOfIdsSpecification implements SqlQuerySpecification, SqlCountSpecification
{
    private $ids;
    private $offset;
    private $limit;

    public function __construct(array $ids, $offset, $limit)
    {
        $this->ids = $ids;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function buildQuery()
    {
        $whereClause = $this->buildWhere();
        $limitClause = $this->buildLimit();
        $query = "SELECT * FROM file f $whereClause ORDER BY f.updated_on DESC $limitClause";
        $parameters = $this->buildParameters();

        return [$query, $parameters];
    }

    public function buildCount()
    {
        $whereClause = $this->buildWhere();
        $limitClause = $this->buildLimit();
        $query = "SELECT COUNT(*) FROM file f $whereClause ORDER BY f.updated_on DESC $limitClause";

        return [$query, $this->buildParameters()];
    }

    private function buildWhere()
    {
        $inString = $this->generateInString($this->ids);
        $whereClause = !empty($this->ids) ? 'WHERE f.id IN (' . $inString . ') ' : '';

        return $whereClause;
    }

    private function buildLimit()
    {
        $limitClause = $this->limit > 0 ? 'LIMIT :limit OFFSET :offset' : '';

        return $limitClause;
    }

    private function buildParameters()
    {
        $parameters = [];
        if (!empty($this->ids)) {
            $parameters = array_merge($this->generateInParameters($this->ids), $parameters);
        }

        if ($this->limit > 0) {
            $parameters = array_merge([':limit' => $this->limit, ':offset' => $this->offset], $parameters);
        }

        return $parameters;
    }

    private function generateInString(array $ids)
    {
        $in = '';
        foreach ($ids as $i => $item) {
            $in .= ":id$i,";
        }

        return rtrim($in, ',');
    }

    private function generateInParameters(array $ids)
    {
        $productVariantIdParams = [];
        foreach ($ids as $i => $item) {
            $productVariantIdParams[":id$i"] = $item;
        }

        return $productVariantIdParams;
    }
}
