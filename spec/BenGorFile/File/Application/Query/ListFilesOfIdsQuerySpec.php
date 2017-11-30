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

namespace spec\BenGorFile\File\Application\Query;

use BenGorFile\File\Application\Query\ListFilesOfIdsQuery;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ListFilesOfIdsQuerySpec extends ObjectBehavior
{
    function it_creates_a_query()
    {
        $this->beConstructedWith(['id-1', 'id-2'], 2, 10);
        $this->shouldHaveType(ListFilesOfIdsQuery::class);
        $this->ids()->shouldReturn(['id-1', 'id-2']);
        $this->page()->shouldReturn(2);
        $this->limit()->shouldReturn(10);
    }

    function it_creates_a_query_without_limit_and_page()
    {
        $this->beConstructedWith(['id-1', 'id-2']);
        $this->shouldHaveType(ListFilesOfIdsQuery::class);
        $this->ids()->shouldReturn(['id-1', 'id-2']);
        $this->page()->shouldReturn(0);
        $this->limit()->shouldReturn(-1);
    }
}
