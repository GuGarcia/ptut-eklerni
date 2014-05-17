<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActiviteRepository extends EntityRepository implements CASRepositoryInterface
{

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Activite", "a")
            ->innerJoin("a.matiere", 'm')
            ->orderBy('m.name, a.name');
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->innerJoin("m.classes", "c")
            ->innerJoin("c.enseignants", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf)
            ->orderBy('m.name, a.name');
    }

    public function findByMatiere($idMatiere)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniDatabaseBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->where("m.id = :id")
            ->setParameter("id", $idMatiere);
    }
}