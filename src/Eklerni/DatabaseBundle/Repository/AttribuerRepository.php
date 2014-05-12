<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 17/04/2014
 * Time: 15:53
 */

namespace Eklerni\DatabaseBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AttribuerRepository extends EntityRepository {

    public function findByEleve($idEleve)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->where("a.idEleve = :idEleve")
            ->setParameter("idSerie", $idEleve );

    }

    public function findBySerie($idSerie)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->where("a.idSerie = :idSerie")
            ->setParameter("idSerie", $idSerie );

    }

} 