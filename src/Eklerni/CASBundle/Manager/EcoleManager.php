<?php

namespace Eklerni\CASBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\CASBundle\Entity\BaseEntity;
use Eklerni\CASBundle\Entity\Eleve;

class EcoleManager extends BaseManager {

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Ecole");
    }

    public function findByEleve(Eleve $eleve) {
        return $this->repository->findById($eleve->getId())->getQuery()->getResult();
    }
}
