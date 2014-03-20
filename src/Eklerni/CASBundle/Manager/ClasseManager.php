<?php

namespace Eklerni\CASBundle\Manager;

use Doctrine\ORM\EntityManager;

class ClasseManager extends BaseManager{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Classe");
    }
} 