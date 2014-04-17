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

    public function findByClasse($idClasse)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->innerJoin("a.eleve", "e")
            ->innerJoin("e.classe", "c")
            ->where("c.id = :idClasse")
            ->setParameter("idClasse", $idClasse);

    }

    public function findById($idEleve, $idSerie) {

        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->where("a.idEleve = :idEleve")
            ->andWhere("a.idSerie = :idSerie")
            ->setParameters(array(
                "idSerie" => $idSerie,
                "idEleve" => $idEleve
            ));
    }
} 