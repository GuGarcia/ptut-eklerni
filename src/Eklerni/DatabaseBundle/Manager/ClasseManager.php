<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Eklerni\DatabaseBundle\Entity\Classe;

class ClasseManager extends BaseManager
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Classe");
    }

    public function clearMatieres(Classe $classe)
    {
        $this->repository->clearMatieres($classe);
    }

    public function clearEnseignants(Classe $classe)
    {
        $this->repository->clearEnseignants($classe);
    }

}