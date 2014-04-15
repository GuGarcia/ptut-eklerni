<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\Activite;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Eklerni\DatabaseBundle\Entity\Matiere;

class SerieManager extends BaseManager {

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Serie");
    }

    public function findByActivite(Activite $activite) {
        return $this->repository->findByActivite($activite->getId())->getQuery()->getResult();
    }

    public function findByMatiere(Matiere $matiere) {
        return $this->repository->findByMatiere($matiere->getId())->getQuery()->getResult();
    }

    public function findAllOrderByMatiereActiviteByProf(Enseignant $enseignant) {
        return $this->repository->findAllOrderByMatiereActiviteByProf($enseignant->getId())->getQuery()->getResult();

    }
} 