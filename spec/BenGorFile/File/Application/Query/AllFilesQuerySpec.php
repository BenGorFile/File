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

use BenGorFile\File\Application\Query\AllFilesQuery;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of AllFilesQuery class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AllFilesQuerySpec extends ObjectBehavior
{
    function it_creates_a_query()
    {
        $this->shouldHaveType(AllFilesQuery::class);
    }
}
