<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;

class ClasseManager extends BaseManager{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Classe");
    }
} 