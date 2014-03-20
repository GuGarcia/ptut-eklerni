<?php

namespace Eklerni\CASBundle\Manager;

use Eklerni\CASBundle\Entity\BaseEntity;
use Eklerni\CASBundle\Entity\Eleve;

class EcoleManager extends BaseEntity {

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Classe");
    }

    public function findByEleve(Eleve $eleve) {
        return $this->repository->findById($eleve->getId())->getQuery()->getResult();
    }
}
