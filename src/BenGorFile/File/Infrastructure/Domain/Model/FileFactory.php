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

namespace BenGorFile\File\Infrastructure\Domain\Model;

use BenGorFile\File\Domain\Model\File;
use BenGorFile\File\Domain\Model\FileFactory as BaseFileFactory;
use BenGorFile\File\Domain\Model\FileId;
use BenGorFile\File\Domain\Model\FileMimeType;
use BenGorFile\File\Domain\Model\FileName;

/**
 * File factory domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileFactory implements BaseFileFactory
{
    /**
     * The entity fully qualified namespace.
     *
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param string $aClass The entity fully qualified namespace
     */
    public function __construct($aClass = File::class)
    {
        $this->class = $aClass;
    }

    /**
     * {@inheritdoc}
     */
    public function build(FileId $anId, FileName $aName, FileMimeType $aMimeType)
    {
        return new $this->class($anId, $aName, $aMimeType);
    }
}
