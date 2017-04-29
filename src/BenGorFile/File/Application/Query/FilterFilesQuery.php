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
 * Filters and paginates files with the given query, limit and offset.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FilterFilesQuery
{
    private $page;
    private $limit;
    private $query;

    public function __construct($query, $page = 0, $limit = -1)
    {
        $this->query = $query;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function query()
    {
        return $this->query;
    }

    public function page()
    {
        return $this->page;
    }

    public function limit()
    {
        return $this->limit;
    }
}
