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

namespace BenGorFile\File\Infrastructure\Domain\Model;

use BenGorFile\File\Domain\Model\FileEvent;

/**
 * File event bus class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
interface FileEventBus
{
    /**
     * Publishes the given domain event.
     *
     * @param FileEvent $anEvent The domain event
     */
    public function handle(FileEvent $anEvent);
}
