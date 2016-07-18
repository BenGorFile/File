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

use BenGorFile\File\Application\Query\FileOfIdQuery;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileOfIdQuery class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfIdQuerySpec extends ObjectBehavior
{
    function it_creates_a_query()
    {
        $this->beConstructedWith('file-id');
        $this->shouldHaveType(FileOfIdQuery::class);
        $this->id()->shouldReturn('file-id');
    }

    function it_cannot_creates_a_query_with_null_id()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(new \InvalidArgumentException('Id cannot be null'))->duringInstantiation();
    }
}
