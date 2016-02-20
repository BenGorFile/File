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

namespace BenGor\File\Infrastructure\Filesystem\Gaufrette;

use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\Filesystem;
use Gaufrette\Filesystem as Gaufrette;

/**
 * Gaufrette filesystem implementation of file domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class GaufretteFilesystem implements Filesystem
{
    /**
     * The Gaufrette filesystem.
     *
     * @var Gaufrette
     */
    private $filesystem;

    /**
     * Constructor.
     *
     * @param Gaufrette $aFilesystem The Gaufrette filesystem
     */
    public function __construct(Gaufrette $aFilesystem)
    {
        $this->filesystem = $aFilesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(FileName $aName, FileExtension $anExtension)
    {
        $this->filesystem->delete($aName->name() . '.' . $anExtension->extension());
    }

    /**
     * {@inheritdoc}
     */
    public function has(FileName $aName, FileExtension $anExtension)
    {
        return $this->filesystem->has($aName->name() . '.' . $anExtension->extension());
    }

    /**
     * {@inheritdoc}
     */
    public function overwrite(FileName $aName, FileExtension $anExtension, $aContent)
    {
        $this->filesystem->write($aName->name() . '.' . $anExtension->extension(), $aContent, true);
    }

    /**
     * {@inheritdoc}
     */
    public function read(FileName $aName, FileExtension $anExtension)
    {
        return $this->filesystem->read($aName->name() . '.' . $anExtension->extension());
    }

    /**
     * {@inheritdoc}
     */
    public function rename(FileName $anOldName, FileName $aNewName)
    {
        $this->filesystem->rename($anOldName->name(), $aNewName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function write(FileName $aName, FileExtension $anExtension, $aContent)
    {
        $this->filesystem->write($aName->name() . '.' . $anExtension->extension(), $aContent);
    }
}
