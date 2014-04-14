<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SerieRepository extends EntityRepository implements CASRepositoryInterface
{

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("s")
            ->from("EklerniDatabaseBundle:Serie", "s");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("s")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->where("s.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("s")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->innerJoin("s.enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }

    public function findByActivite($idActivite)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->innerJoin("s.activite","a")
            ->where("a.id = :id")
            ->setParameter("id", $idActivite);
    }

    public function findByMatiere($idMatiere)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->innerJoin("s.activite","a")
            ->innerJoin("a.matiere","m")
            ->where("m.id = :id")
            ->setParameter("id", $idMatiere);
    }

}