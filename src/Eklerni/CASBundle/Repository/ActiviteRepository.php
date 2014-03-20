<?php

namespace Eklerni\CASBundle\Repository;

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
            ->from("EklerniCASBundle:Activite", "a");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniCASBundle:Activite", "a")
            ->where("a.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniCASBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->innerJoin("m.classes", "c")
            ->innerJoin("c.enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }

    public function findByMatiere($idMatiere)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniCASBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->where("m.id = :id")
            ->setParameter("id", $idMatiere);
    }
}