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
 * File repository domain interface.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
interface FileRepository
{
    /**
     * Finds the file of given id.
     *
     * @param FileId $anId The file id
     *
     * @return File
     */
    public function fileOfId(FileId $anId);

    /**
     * Finds the file of given name.
     *
     * @param string $aName The file name
     *
     * @return File
     */
    public function fileOfName($aName);

    /**
     * Persists the given file.
     *
     * @param File $aFile The file
     */
    public function persist(File $aFile);

    /**
     * Removes the given file.
     *
     * @param File $aFile The file
     */
    public function remove(File $aFile);

    /**
     * Counts the files.
     *
     * @return int
     */
    public function size();

    /**
     * Gets the next file id.
     *
     * @return FileId
     */
    public function nextIdentity();
}
