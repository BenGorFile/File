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
     * Removes the file of given file name.
     *
     * @param FileName $aName The file name
     */
    public function delete(FileName $aName);

    /**
     * Checks if the file of given file name exists.
     *
     * @param FileName $aName The file name
     *
     * @return bool
     */
    public function has(FileName $aName);

    /**
     * Overwrites the file of name given with a given content.
     *
     * @param FileName $aName    The file name
     * @param string   $aContent The content
     */
    public function overwrite(FileName $aName, $aContent);

    /**
     * Reads the file content of given file name.
     *
     * @param FileName $aName The file name
     *
     * @return string
     */
    public function read(FileName $aName);

    /**
     * Renames the file of given old file
     * name with the given new file name.
     *
     * @param FileName $anOldName The actual file name
     * @param FileName $aNewName  The new file name
     */
    public function rename(FileName $anOldName, FileName $aNewName);

    /**
     * Writes a new file with name and content given.
     *
     * @param FileName $aName    The file name
     * @param string   $aContent The content
     */
    public function write(FileName $aName, $aContent);
}
