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
    public function delete(FileName $aName)
    {
        $this->filesystem->delete($aName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function has(FileName $aName)
    {
        return $this->filesystem->has($aName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function overwrite(FileName $aName, $aContent)
    {
        $this->filesystem->write($aName->name(), $aContent, true);
    }

    /**
     * {@inheritdoc}
     */
    public function read(FileName $aName)
    {
        return $this->filesystem->read($aName->name());
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
    public function write(FileName $aName, $aContent)
    {
        $this->filesystem->write($aName->name(), $aContent);
    }
}
