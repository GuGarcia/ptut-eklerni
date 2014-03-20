<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 20/03/2014
 * Time: 10:30
 */

namespace Eklerni\CASBundle\Manager;


use Doctrine\ORM\EntityManager;

class ClasseManager extends BaseManager{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Classe");
    }
} 