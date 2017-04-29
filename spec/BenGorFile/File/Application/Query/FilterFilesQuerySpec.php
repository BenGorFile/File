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

use BenGorFile\File\Application\Query\FilterFilesQuery;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FilterFilesQuery class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FilterFilesQuerySpec extends ObjectBehavior
{
    function it_creates_a_query()
    {
        $this->beConstructedWith('filena');
        $this->shouldHaveType(FilterFilesQuery::class);
        $this->query()->shouldReturn('filena');
        $this->page()->shouldReturn(0);
        $this->limit()->shouldReturn(-1);
    }
}
