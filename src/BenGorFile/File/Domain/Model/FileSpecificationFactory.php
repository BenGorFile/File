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

namespace BenGorFile\File\Domain\Model;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface FileSpecificationFactory
{
    public function buildFilterByNameSpecification($fileName, $offset = 0, $limit = -1);

    public function buildListOfIdsSpecification(array $ids, $offset = 0, $limit = -1);

    public function buildByNameSpecification(FileName $aName);
}
