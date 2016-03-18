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

namespace BenGor\File\Infrastructure\Filesystem\InMemory;

use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\Filesystem;

/**
 * In memory filesystem implementation of file domain class.
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
    public function delete(FileName $aName, FileExtension $anExtension)
    {
        foreach ($this->files as $key => $file) {
            if ($file['name'] === $aName->name()) {
                if ($file['extension'] === $anExtension->extension()) {
                    unset($this->files[$key]);
                    break;
                }
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function has(FileName $aName, FileExtension $anExtension)
    {
        foreach ($this->files as $file) {
            if ($file['name'] === $aName->name()) {
                if ($file['extension'] === $anExtension->extension()) {
                    return true;
                }
            }
        };

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function overwrite(FileName $aName, FileExtension $anExtension, $aContent)
    {
        foreach ($this->files as $key => $file) {
            if ($file['name'] === $aName->name()) {
                if ($file['extension'] === $anExtension->extension()) {
                    $this->files[$key]['content'] = $aContent;
                    break;
                }
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function read(FileName $aName, FileExtension $anExtension)
    {
        foreach ($this->files as $key => $file) {
            if ($file['name'] === $aName->name()) {
                if ($file['extension'] === $anExtension->extension()) {
                    return $this->files[$key];
                }
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function rename(FileName $anOldName, FileName $aNewName)
    {
        foreach ($this->files as $key => $file) {
            if ($file['name'] === $anOldName->name()) {
                $this->files[$key]['name'] = $aNewName->name();
                break;
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function write(FileName $aName, FileExtension $anExtension, $aContent)
    {
        foreach ($this->files as $key => $file) {
            if ($file['name'] === $aName->name()) {
                if ($file['extension'] === $anExtension->extension()) {
                    return;
                }
            }
        };
        $this->files[] = ['name' => $aName->name(), 'extension' => $anExtension->extension(), 'content' => $aContent];
    }
}
