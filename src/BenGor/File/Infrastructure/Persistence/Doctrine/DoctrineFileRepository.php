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

namespace BenGor\File\Infrastructure\Persistence\Doctrine;

use BenGor\File\Domain\Model\File;
use BenGor\File\Domain\Model\FileExtension;
use BenGor\File\Domain\Model\FileId;
use BenGor\File\Domain\Model\FileName;
use BenGor\File\Domain\Model\FileRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Doctrine file repository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class DoctrineFileRepository extends EntityRepository implements FileRepository
{
    /**
     * {@inheritdoc}
     */
    public function fileOfId(FileId $anId)
    {
        return $this->find($anId->id());
    }

    /**
     * {@inheritdoc}
     */
    public function fileOfName(FileName $aName, FileExtension $anExtension)
    {
        return $this->findOneBy(['name.name' => $aName->name(), 'extension.extension' => $anExtension->extension()]);
    }

    /**
     * {@inheritdoc}
     */
    public function filesOfExtension(FileExtension $anExtension)
    {
        return $this->findBy(['extension.extension' => $anExtension]);
    }

    /**
     * {@inheritdoc}
     */
    public function persist(File $aFile)
    {
        $this->getEntityManager()->persist($aFile);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(File $aFile)
    {
        $this->getEntityManager()->remove($aFile);
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        $queryBuilder = $this->createQueryBuilder('f');

        return $queryBuilder
            ->select($queryBuilder->expr()->count('f.id.id'))
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity()
    {
        return new FileId();
    }
}
