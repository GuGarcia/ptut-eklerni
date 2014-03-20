<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 20/03/2014
 * Time: 11:40
 */

namespace Eklerni\CASBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\CASBundle\Entity\Classe;

class MatiereManager extends BaseManager{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Matiere");
    }

    public function findByClasse(Classe $classe) {
        return $this->repository->findByClasse($classe->getId())->getQuery()->getResult();
    }
} 