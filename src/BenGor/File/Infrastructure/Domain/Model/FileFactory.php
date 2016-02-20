<?php

/*
 * This file is part of the BenGorFile library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGor\File\Infrastructure\Domain\Model;

use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileFactory as BaseFileFactory;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;

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
    public function build(FileId $anId, FileName $aName, FileExtension $anExtension)
    {
        return new $this->class($anId, $aName, $anExtension);
    }
}
