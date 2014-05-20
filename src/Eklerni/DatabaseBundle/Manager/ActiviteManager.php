<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\Matiere;

class ActiviteManager extends BaseManager
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Activite");
    }

    public function findByMatiere(Matiere $matiere)
    {
        return $this->repository->findByMatiere($matiere->getId())->getQuery()->getResult();
    }
} 