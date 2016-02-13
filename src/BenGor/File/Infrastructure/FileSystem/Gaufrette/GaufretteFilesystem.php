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

namespace BenGor\File\Infrastructure\Filesystem;

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
    public function write($path, $content)
    {
        $this->filesystem->write($path, $content);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($path)
    {
        $this->filesystem->remove($path);
    }
}
