<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\BaseEntity;
use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Serie;

class AttribuerManager
{

    /**
     * @var EntityManager
     */
    protected $em;
    /**
     * @var EntityRepository
     */
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Attribuer");
    }

    /**
     * Save Entity in database
     * @param BaseEntity $entity
     * @param bool $persist false when updating
     */
    public function save(BaseEntity $entity, $persist = true)
    {
        if ($entity->getId() == null) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    public function remove(Attribuer $attribuer) {
        if(count($attribuer->getResultats()) > 0) {
            $attribuer->setIsDelete(true);
        } else {
            $this->em->remove($attribuer);
        }
        $this->em->flush();
    }

    public function findByEleve(Eleve $eleve)
    {
        //return $this->repository->findByEleve($eleve->getId())->getQuery()->getResult();

        return $this->repository->createQueryBuilder("p")
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->innerJoin("a.eleve", "e")
            ->where("e.id = :idEleve")
            ->andwhere("a.isDelete = 0")
            ->setParameter("idEleve", $eleve->getId() )->getQuery()->getResult();
    }

    public function findBySerie(Serie $serie)
    {
        return $this->repository->findBySerie($serie->getId())->getQuery()->getResult();
    }

    public function findByClasse(Classe $classe)
    {
        $query = $this->repository->createQueryBuilder("p")
            ->select("a")->distinct()
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->innerJoin("a.eleve", "e")
            ->innerJoin("e.classe", "c")
            ->where("c.id = :idClasse and a.isClasse = 1")
            ->andwhere("a.isDelete = 0")
            ->groupBy("a.serie")
            ->setParameter("idClasse", $classe->getId());
        return $query->getQuery()->getResult();
    }

    public function findById(Eleve $eleve, Serie $serie)
    {
         $query = $this->repository->createQueryBuilder("p")
            ->select("a")
            ->from("EklerniDatabaseBundle:Attribuer", "a")
            ->where("a.eleve = :idEleve")
            ->andWhere("a.serie = :idSerie")
             ->andwhere("a.isDelete = 0")
            ->setParameters(array(
                "idSerie" => $serie->getId(),
                "idEleve" => $eleve->getId()
            ));
        return $query->getQuery()->getResult();
    }

//  public function findByIdClasseSerie(Classe $classe, Serie $serie) {
//      return $this->repository->findById($classe->getId(), $serie->getId())->getQuery()->getResult();
//  }
} 