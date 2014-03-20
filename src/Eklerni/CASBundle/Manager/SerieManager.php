<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 20/03/2014
 * Time: 11:56
 */

namespace Eklerni\CASBundle\Manager;


use Doctrine\ORM\EntityManager;
use Eklerni\CASBundle\Entity\Activite;

class SerieManager extends BaseManager {

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Serie");
    }

    public function findByActivite(Activite $activite) {
        return $this->repository->findByActivite($activite->getId())->getQuery()->getResult();
    }

    public function findByMatiere(Matiere $matiere) {
        return $this->repository->findByMatiere($matiere->getId())->getQuery()->getResult();
    }
} 