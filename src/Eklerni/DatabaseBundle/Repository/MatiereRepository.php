<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MatiereRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Matiere", "m")
            ->orderBy('m.name');
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Matiere", "m")
            ->where("m.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Matiere", "m")
            ->innerJoin("m.classes","c")
            ->innerJoin("c.enseignants","e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf)
            ->orderBy('m.name');
    }

    public function findByClasse($idClasse) {

        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Matiere", "m")
            ->innerJoin("m.classes","c")
            ->where("c.id = :id")
            ->setParameter("id", $idClasse);
    }
}