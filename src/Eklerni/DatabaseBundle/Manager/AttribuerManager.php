<?php

namespace Eklerni\DatabaseBundle\Manager;

use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Serie;

class AttribuerManager {

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
    }

    /**
     * Save Entity in database
     * @param BaseEntity $entity
     * @param bool $persist false when updating
     */
    public function save(BaseEntity $entity, $persist = true)
    {
        if ($persist) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    public function findByEleve(Eleve $eleve)
    {
        return $this->repository->findByEleve($eleve->getId())->getQuery()->getResult();

    }

    public function findBySerie(Serie $serie)
    {
        return $this->repository->findBySerie($serie->getId())->getQuery()->getResult();
    }

    public function findByClasse(Classe $classe)
    {
        return $this->repository->findByClasse($classe->getId())->getQuery()->getResult();
    }

    public function findById(Eleve $eleve, Serie $serie) {
        return $this->repository->findById($eleve->getId(), $serie->getId())->getQuery()->getResult();
    }

//  public function findByIdClasseSerie(Classe $classe, Serie $serie) {
//      return $this->repository->findById($classe->getId(), $serie->getId())->getQuery()->getResult();
//  }
} 