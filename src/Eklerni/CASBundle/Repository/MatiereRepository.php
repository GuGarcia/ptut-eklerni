<?php

namespace Eklerni\CASBundle\Repository;

class MatiereRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findByAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniCASBundle:Matiere", "m");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EkleniCASBundle:Matiere", "m")
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
            ->from("EkleniCASBundle:Matiere", "m")
            ->innerJoin("m.classes","c")
            ->innerJoin("c.enseignant","e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }

    public function findByClasse($idClasse) {

        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EkleniCASBundle:Matiere", "m")
            ->innerJoin("m.classes","c")
            ->where("c.id = :id")
            ->setParameter("id", $idClasse);
    }
}