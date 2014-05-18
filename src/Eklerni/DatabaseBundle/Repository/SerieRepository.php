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
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->innerJoin("s.activite", 'a')
            ->innerJoin("a.matiere", 'm')
            ->orderBy('m.name, a.name, s.nom');
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
            ->innerJoin("s.activite", 'a')
            ->innerJoin("a.matiere", 'm')
            ->where("e.id = :id")
            ->setParameter("id", $idProf)
            ->orderBy('m.name, a.name, s.nom');
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

    public function findAllOrderByMatiereActivite()
    {
        return $this->_em->createQueryBuilder()
            ->select("s")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->innerJoin("s.activite","a")
            ->innerJoin("a.matiere","m")
            ->orderBy(array("m.name" => "asc", "a.name" => "asc")
            );
    }

    public function findAllOrderByMatiereActiviteByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("s, m.name as HIDDEN matiere, a.name as HIDDEN activite")
            ->from("EklerniDatabaseBundle:Serie", "s")
            ->leftJoin("s.enseignant", "e")
            ->leftJoin("s.activite", "a")
            ->leftJoin("a.matiere", "m")
            ->where("e.id = :id")
            ->setParameter("id", $idProf)
            ->addOrderBy("matiere", "asc")
            ->addOrderBy("activite", "asc");

    }

}