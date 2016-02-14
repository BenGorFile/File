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

namespace BenGor\File\Domain\Model;

use Ddd\Domain\DomainEvent;
use Ddd\Domain\Event\PublishableDomainEvent;

/**
 * File uploaded domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class FileUploaded implements DomainEvent, PublishableDomainEvent
{
    /**
     * The file.
     *
     * @var File
     */
    private $file;

    /**
     * The occurred on.
     *
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @param File $aFile The file
     */
    public function __construct(File $aFile)
    {
        $this->file = $aFile;
        $this->occurredOn = new \DateTimeImmutable();
    }

    /**
     * Gets the file.
     *
     * @return File
     */
    public function file()
    {
        return $this->file;
    }

    /**
     * Gets the occurred on.
     *
     * @return \DateTimeImmutable
     */
    public function occurredOn()
    {
        return $this->occurredOn;
    }
}
