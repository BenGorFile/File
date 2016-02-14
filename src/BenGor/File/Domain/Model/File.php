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

use BenGor\File\Domain\Event\FileOverwritten;
use BenGor\File\Domain\Event\FileUploaded;
use Ddd\Domain\DomainEventPublisher;

/**
 * File domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class File
{
    /**
     * The id.
     *
     * @var FileId
     */
    protected $id;

    /**
     * Created on.
     *
     * @var \DateTimeImmutable
     */
    protected $createdOn;

    /**
     * The name.
     *
     * @var FileName
     */
    protected $name;

    /**
     * Updated on.
     *
     * @var \DateTimeImmutable
     */
    protected $updatedOn;

    /**
     * Constructor.
     *
     * @param FileId                  $anId        The id
     * @param FileName                $aName       The file name
     * @param \DateTimeImmutable|null $aCreatedOn  The created on
     * @param \DateTimeImmutable|null $anUpdatedOn The updated on
     */
    public function __construct(
        FileId $anId,
        FileName $aName,
        \DateTimeImmutable $aCreatedOn = null,
        \DateTimeImmutable $anUpdatedOn = null
    ) {
        $this->id = $anId;
        $this->name = $aName;
        $this->createdOn = $aCreatedOn ?: new \DateTimeImmutable();
        $this->updatedOn = $anUpdatedOn ?: new \DateTimeImmutable();

        DomainEventPublisher::instance()->publish(new FileUploaded($this));
    }

    /**
     * Gets the id.
     *
     * @return FileId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Gets the created on.
     *
     * @return \DateTimeImmutable
     */
    public function createdOn()
    {
        return $this->createdOn;
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
     * Overwrites the file.
     *
     * @param FileName $aName The file name
     */
    public function overwrite(FileName $aName)
    {
        $this->name = $aName;
        $this->updatedOn = new \DateTimeImmutable();

        DomainEventPublisher::instance()->publish(new FileOverwritten($this));
    }

    /**
     * Gets the updated on.
     *
     * @return \DateTimeImmutable
     */
    public function updatedOn()
    {
        return $this->updatedOn;
    }
}
