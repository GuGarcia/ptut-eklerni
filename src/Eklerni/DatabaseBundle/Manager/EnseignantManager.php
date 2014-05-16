<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\BaseEntity;

class EnseignantManager extends BaseManager
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Enseignant");
    }

    /**
     * {@inheritdoc}
     */
    public function save(BaseEntity $entity)
    {
        if (property_exists($entity, 'dateModification')) {
            $entity->setDateModification(new \DateTime('now'));
        }

        if (null === $entity->getId()) {
            if (property_exists($entity, 'dateCreation')) {
                $entity->setDateCreation(new \DateTime('now'));
            }
            $this->em->persist($entity);
        }
        $this->em->flush();
        $entity->upload();
        $this->em->flush();
    }
} 