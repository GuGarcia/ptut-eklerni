<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\BaseEntity;

class EleveManager extends BaseManager
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Eleve");
    }

    /**
     * {@inheritdoc}
     */
    public function save(BaseEntity $entity)
    {
        if (property_exists($entity, 'dateModification')) {
            $entity->setDateModification(new \DateTime('now'));
        }

        if (0 === $entity->getId()) {
            if (property_exists($entity, 'dateCreation')) {
                $entity->setDateCreation(new \DateTime('now'));
            }
            $this->em->persist($entity);
        }
        // TODO GV Finish
        $this->em->flush();
        $entity->upload();
        $this->em->flush();
    }
}
