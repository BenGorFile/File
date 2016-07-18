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
 * File factory domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface FileFactory
{
    /**
     * Registers the file with given id, email and password.
     *
     * @param FileId       $anId      The file id
     * @param FileName     $aName     The file name
     * @param FileMimeType $aMimeType The file mime type
     *
     * @return File
     */
    public function build(FileId $anId, FileName $aName, FileMimeType $aMimeType);
}
