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

use BenGorFile\File\Domain\Model\FileName;
use BenGorFile\File\Domain\Model\Filesystem;

/**
 * In memory implementation of filesystem domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class InMemoryFilesystem implements Filesystem
{
    /**
     * The file collection.
     *
     * @var array
     */
    private $files;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->files = [];
    }

    /**
     * {@inheritdoc}
     */
    public function delete(FileName $aName)
    {
        foreach ($this->files as $key => $file) {
            if ($file['filename'] === $aName->filename()) {
                unset($this->files[$key]);
                break;
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function has(FileName $aName)
    {
        foreach ($this->files as $file) {
            if ($file['filename'] === $aName->filename()) {
                return true;
            }
        };

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function overwrite(FileName $aName, $aContent)
    {
        foreach ($this->files as $key => $file) {
            if ($file['filename'] === $aName->filename()) {
                $this->files[$key]['content'] = $aContent;
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function read(FileName $aName)
    {
        foreach ($this->files as $key => $file) {
            if ($file['filename'] === $aName->filename()) {
                return $this->files[$key];
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function rename(FileName $anOldName, FileName $aNewName)
    {
        foreach ($this->files as $key => $file) {
            if ($file['filename'] === $anOldName->filename()) {
                $this->files[$key]['filename'] = $aNewName->filename();
                break;
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function write(FileName $aName, $aContent)
    {
        foreach ($this->files as $key => $file) {
            if ($file['filename'] === $aName->filename()) {
                return;
            }
        };
        $this->files[] = ['filename' => $aName->filename(), 'content' => $aContent];
    }
}
