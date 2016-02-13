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

namespace BenGor\File\Infrastructure\UploadedFile\Symfony;

use BenGor\File\Domain\Model\UploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile as Symfony;

/**
 * Symfony uploaded file class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class SymfonyUploadedFile implements UploadedFile
{
    /**
     * The Symfony uploaded file.
     *
     * @var Symfony
     */
    private $uploadedFile;

    /**
     * Constructor.
     *
     * @param Symfony $anUploadedFile The Symfony uploaded file
     */
    public function __construct(Symfony $anUploadedFile)
    {
        $this->uploadedFile = $anUploadedFile;
    }

    /**
     * {@inheritdoc}
     */
    public function content()
    {
        return file_get_contents($this->uploadedFile->getPathname());
    }

    /**
     * {@inheritdoc}
     */
    public function extension()
    {
        return $this->uploadedFile->getExtension();
    }
}
