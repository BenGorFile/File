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

namespace BenGor\File\Infrastructure\UploadedFile\Test;

use BenGor\File\Domain\Model\UploadedFile;

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
     * Constructor.
     *
     * @param string $aContent    The content
     * @param string $anExtension The extension
     */
    public function __construct($aContent, $anExtension)
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
}
