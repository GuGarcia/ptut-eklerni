<?php

namespace Eklerni\DatabaseBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ResultatRepository extends EntityRepository implements CASRepositoryInterface {


    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("r")
            ->from("EklerniDatabaseBundle:Resultat", "r");
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("r")
            ->from("EklerniDatabaseBundle:Resultat", "r")
            ->innerJoin("r.serie", "s")
            ->innerJoin("s.enseignant", "e")
            ->where("e.id = :idProf")
            ->setParameter("idProf", $idProf);
    }

    /**
     * @param $idEleve integer
     * @return mixed
     */
    public function findByEleve($idEleve)
    {
        return $this->_em->createQueryBuilder()
            ->select("r")
            ->from("EklerniDatabaseBundle:Resultat", "r")
            ->innerJoin("r.eleve", "e")
            ->where("e.id = :idEleve")
            ->setParameter("idEleve", $idEleve);
    }
}