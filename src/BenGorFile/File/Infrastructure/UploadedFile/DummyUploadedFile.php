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

namespace BenGorFile\File\Infrastructure\UploadedFile;

use BenGorFile\File\Domain\Model\UploadedFile;

/**
 * Dummy uploaded file class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class DummyUploadedFile implements UploadedFile
{
    /**
     * The content.
     *
     * @var string
     */
    private $content;

    /**
     * The extension.
     *
     * @var string
     */
    private $extension;

    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string $aContent    The content
     * @param string $aName       The name
     * @param string $anExtension The extension
     */
    public function __construct($aContent, $aName, $anExtension)
    {
        $this->content = $aContent;
        $this->extension = $anExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function extension()
    {
        return $this->extension;
    }

    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return $this->name;
    }
}
