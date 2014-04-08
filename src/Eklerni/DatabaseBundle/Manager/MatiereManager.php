<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\Classe;

class MatiereManager extends BaseManager{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Matiere");
    }

    public function findByClasse(Classe $classe) {
        return $this->repository->findByClasse($classe->getId())->getQuery()->getResult();
    }
} 