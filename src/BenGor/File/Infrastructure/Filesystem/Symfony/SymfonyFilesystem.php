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

namespace BenGor\File\Infrastructure\Filesystem\Symfony;

use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\Filesystem;
use Symfony\Component\Filesystem\Filesystem as Symfony;

/**
 * Symfony filesystem implementation of file domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class SymfonyFilesystem implements Filesystem
{
    /**
     * The Symfony filesystem.
     *
     * @var Symfony
     */
    private $filesystem;

    /**
     * The path.
     *
     * @var string
     */
    private $path;

    /**
     * Constructor.
     *
     * @param string  $aPath       The path
     * @param Symfony $aFilesystem The Symfony filesystem
     */
    public function __construct($aPath, Symfony $aFilesystem)
    {
        $this->filesystem = $aFilesystem;
        $this->path = rtrim($aPath, '/') . '/';
    }

    /**
     * {@inheritdoc}
     */
    public function delete(FileName $aName)
    {
        $this->filesystem->remove($this->path . $aName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function has(FileName $aName)
    {
        return $this->filesystem->exists($this->path . $aName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function overwrite(FileName $aName, $aContent)
    {
        $this->filesystem->dumpFile($this->path . $aName->name(), $aContent);
    }

    /**
     * {@inheritdoc}
     */
    public function read(FileName $aName)
    {
        return file_get_contents($this->path . $aName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function rename(FileName $anOldName, FileName $aNewName)
    {
        $this->filesystem->rename($this->path . $anOldName->name(), $this->path . $aNewName->name());
    }

    /**
     * {@inheritdoc}
     */
    public function write(FileName $aName, $aContent)
    {
        $this->filesystem->dumpFile($this->path . $aName->name(), $aContent);
    }
}
