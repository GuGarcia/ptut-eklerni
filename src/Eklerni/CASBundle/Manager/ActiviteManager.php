<?php

namespace Eklerni\CASBundle\Manager;

class ActiviteManager extends EntityRepository implements CASRepositoryInterface
{

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniCASBundle:Activite");
    }

    public function findByMatiere(Matiere $matiere) {
        return $this->repository->findByMatiere($matiere->getId())->getQuery()->getResult();
    }
} 