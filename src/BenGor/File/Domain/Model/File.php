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
     * @var string
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
     * @param string                  $aName       The file name
     * @param \DateTimeImmutable|null $aCreatedOn  The created on
     * @param \DateTimeImmutable|null $anUpdatedOn The updated on
     */
    public function __construct(
        FileId $anId,
        $aName,
        \DateTimeImmutable $aCreatedOn = null,
        \DateTimeImmutable $anUpdatedOn = null
    ) {
        $this->id = $anId;
        $this->name = $aName;
        $this->createdOn = $aCreatedOn ?: new \DateTimeImmutable();
        $this->updatedOn = $anUpdatedOn ?: new \DateTimeImmutable();
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
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Updates the file.
     *
     * @param string $aName The file name
     */
    public function update($aName)
    {
        $this->name = $aName;
        $this->updatedOn = new \DateTimeImmutable();
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
