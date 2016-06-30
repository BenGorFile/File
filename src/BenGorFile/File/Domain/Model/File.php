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
     * The extension.
     *
     * @var FileExtension
     */
    protected $extension;

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
     * @param FileId        $anId        The id
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     */
    public function __construct(FileId $anId, FileName $aName, FileExtension $anExtension)
    {
        $this->id = $anId;
        $this->name = $aName;
        $this->createdOn = new \DateTimeImmutable();
        $this->updatedOn = new \DateTimeImmutable();
        $this->setExtension($anExtension);

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
     * Gets the file extension.
     *
     * @return FileExtension
     */
    public function extension()
    {
        return $this->extension;
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
     * Gets the updated on.
     *
     * @return \DateTimeImmutable
     */
    public function updatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Gets the available extension => mime-type pairs.
     *
     * Example of returned array structure:
     *      [
     *          'jpeg' => 'image/jpeg',
     *          'jpg'  => 'image/jpeg',
     *          'pdf'  => 'application/pdf',
     *      ]
     *
     * This method is an extension point that it allows
     * to limit the mime-types easily in the domain.
     *
     * @return array
     */
    public static function availableMimeTypes()
    {
        return FileExtension::mimeTypes();
    }

    /**
     * Magic method that represents the file
     * domain object in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name->name() . '.' . $this->extension->extension();
    }

    /**
     * Sets the extension given if it appears between allowed extensions.
     *
     * @param FileExtension $anExtension The file extension
     *
     * @throws FileExtensionException when the extension does not support
     */
    protected function setExtension(FileExtension $anExtension)
    {
        if (false === array_key_exists($anExtension->extension(), static::availableMimeTypes())) {
            throw FileExtensionException::doesNotSupport($anExtension);
        }
        $this->extension = $anExtension;
    }
}
