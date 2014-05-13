<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Eklerni\DatabaseBundle\Entity\Classe;

class ClasseRepository extends EntityRepository implements CASRepositoryInterface
{

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EklerniDatabaseBundle:Classe", "c");
    }

    /**
     * @param $id integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EklerniDatabaseBundle:Classe", "c")
            ->where("c.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EklerniDatabaseBundle:Classe", "c")
            ->innerJoin("c.enseignants", "p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);

    }

    public function clearMatieres(Classe $classe)
    {
        $this->_em->getConnection()
            ->prepare("DELETE FROM t_classeMatiere WHERE classe_id = :id;")
            ->execute(array("id" => $classe->getId()));
        $this->_em->flush();
    }

    public function clearEnseignants(Classe $classe)
    {
        $this->_em->getConnection()
            ->prepare("DELETE FROM t_classeEnseignant WHERE classe_id = :id;")
            ->execute(array("id" => $classe->getId()));
        $this->_em->flush();
    }

}