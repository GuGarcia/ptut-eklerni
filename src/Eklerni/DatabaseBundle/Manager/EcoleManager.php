<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\Eleve;

class EcoleManager extends BaseManager
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Ecole");
    }

    public function findByEleve(Eleve $eleve)
    {
        return $this->repository->findById($eleve->getId())->getQuery()->getResult();
    }
}
