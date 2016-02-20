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
 * Filesystem domain interface.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
interface Filesystem
{
    /**
     * Removes the file of given filename.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     */
    public function delete(FileName $aName, FileExtension $anExtension);

    /**
     * Checks if the file of given filename exists.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return bool
     */
    public function has(FileName $aName, FileExtension $anExtension);

    /**
     * Overwrites the file of filename given with a given content.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     * @param string        $aContent    The content
     */
    public function overwrite(FileName $aName, FileExtension $anExtension, $aContent);

    /**
     * Reads the file content of given filename.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return string
     */
    public function read(FileName $aName, FileExtension $anExtension);

    /**
     * Renames the file of given old file
     * name with the given new file name.
     *
     * @param FileName $anOldName The actual file name
     * @param FileName $aNewName  The new file name
     */
    public function rename(FileName $anOldName, FileName $aNewName);

    /**
     * Writes a new file with filename and content given.
     *
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     * @param string        $aContent    The content
     */
    public function write(FileName $aName, FileExtension $anExtension, $aContent);
}
