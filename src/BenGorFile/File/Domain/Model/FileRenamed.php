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

namespace BenGorFile\File\Domain\Model;

/**
 * File renamed domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class FileRenamed implements FileEvent
{
    /**
     * The file id.
     *
     * @var FileId
     */
    private $id;

    /**
     * The occurred on.
     *
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @param FileId $aFileId The file id
     */
    public function __construct(FileId $aFileId)
    {
        $this->id = $aFileId;
        $this->occurredOn = new \DateTimeImmutable();
    }

    /**
     * Gets the file id.
     *
     * @return FileId
     */
    public function id()
    {
        return $this->id;
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
