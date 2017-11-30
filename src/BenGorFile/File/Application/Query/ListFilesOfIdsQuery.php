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
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ListFilesOfIdsQuery
{
    private $page;
    private $limit;
    private $ids;

    public function __construct(array $ids, $page = 0, $limit = -1)
    {
        $this->ids = $ids;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function ids()
    {
        return $this->ids;
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
