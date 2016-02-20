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
 * File factory domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface FileFactory
{
    /**
     * Registers the user with given id, email and password.
     *
     * @param FileId        $anId        The file id
     * @param FileName      $aName       The file name
     * @param FileExtension $anExtension The file extension
     *
     * @return File
     */
    public function build(FileId $anId, FileName $aName, FileExtension $anExtension);
}
