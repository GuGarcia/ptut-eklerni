<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EleveRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e")
            ->orderBy("e.nom")
            ->orderBy("e.prenom");
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e")
            ->innerJoin("e.classe","c")
            ->innerJoin("c.enseignants","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);
    }

    /**
     * @param $idClasse
     * @return mixed
     */
    public function findByClasse($idClasse)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e")
            ->innerJoin("e.classe","c")
            ->where("c.id = :id")
            ->orderBy("e.nom, e.prenom")
            ->setParameter("id", $idClasse);
    }

    /**
     * @param string $username
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function isUsernameExists($username) {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e")
            ->where("e.username = :username")
            ->setParameter("username", $username);
    }
}