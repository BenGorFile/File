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

use BenGorFile\File\Application\Query\FileOfNameQuery;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of FileOfNameQuery class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileOfNameQuerySpec extends ObjectBehavior
{
    function it_creates_a_query()
    {
        $this->beConstructedWith('file.pdf');
        $this->shouldHaveType(FileOfNameQuery::class);
        $this->name()->shouldReturn('file.pdf');
    }

    function it_cannot_creates_a_query_with_null_name()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(new \InvalidArgumentException('Name cannot be null'))->duringInstantiation();
    }
}
