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
 * File uploaded domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class FileUploaded implements FileEvent
{
    /**
     * The file id.
     *
     * @var FileId
     */
    private $id;

    /**
     * The file name.
     *
     * @var FileName
     */
    private $name;

    /**
     * The occurred on.
     *
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @param FileId   $aFileId The file id
     * @param FileName $aName   The file name
     */
    public function __construct(FileId $aFileId, FileName $aName)
    {
        $this->id = $aFileId;
        $this->name = $aName;
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
     * Gets the file name.
     *
     * @return FileName
     */
    public function name()
    {
        return $this->name;
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
