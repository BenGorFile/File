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
 * File domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class File extends FileAggregateRoot
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
     * The file mime type.
     *
     * @var FileMimeType
     */
    protected $mimeType;

    /**
     * The file name.
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
     * @param FileId       $anId      The id
     * @param FileName     $aName     The file name
     * @param FileMimeType $aMimeType The file mime type
     */
    public function __construct(FileId $anId, FileName $aName, FileMimeType $aMimeType)
    {
        $this->id = $anId;
        $this->name = $aName;
        $this->createdOn = new \DateTimeImmutable();
        $this->updatedOn = new \DateTimeImmutable();
        $this->setMimeType($aMimeType);

        $this->publish(new FileUploaded($this->id()));
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
     * Gets the file mime type.
     *
     * @return FileMimeType
     */
    public function mimeType()
    {
        return $this->mimeType;
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
     * @param FileName     $aName     The file name
     * @param FileMimeType $aMimeType The file mime type
     */
    public function overwrite(FileName $aName, FileMimeType $aMimeType)
    {
        $this->name = $aName;
        $this->mimeType = $aMimeType;
        $this->updatedOn = new \DateTimeImmutable();

        $this->publish(new FileOverwritten($this->id()));
    }

    /**
     * Removes the file.
     */
    public function remove()
    {
        $this->publish(new FileRemoved($this->id()));
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

    /**
     * Magic method that represents the file domain object in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name->filename();
    }

    /**
     * Gets the available mime types in scalar type.
     *
     * This method is an extension point that it allows
     * to add more mime types easily in the domain.
     *
     * @return array
     */
    protected function availableMimeTypes()
    {
        return FileMimeType::mimeTypes();
    }

    /**
     * Sets the given mime type in the file scope.
     *
     * @param FileMimeType $aMimeType The mime type
     *
     * @throws FileMimeTypeException when the given mime type is not support for the file
     */
    private function setMimeType(FileMimeType $aMimeType)
    {
        if (!in_array($aMimeType->mimeType(), $this->availableMimeTypes(), true)) {
            throw FileMimeTypeException::doesNotSupport($aMimeType->mimeType());
        }
        $this->mimeType = $aMimeType;
    }
}
