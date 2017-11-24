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

use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\FileSpecificationFactory;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlFileSpecificationFactory implements FileSpecificationFactory
{
    public function buildFilterByNameSpecification($fileName, $offset = 0, $limit = -1)
    {
        return new SqlFilterByNameSpecification($fileName, $offset, $limit);
    }

    public function buildByNameSpecification(FileName $fileName)
    {
        return new SqlByNameSpecification($fileName);
    }
}
