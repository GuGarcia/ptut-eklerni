<?php

namespace Eklerni\DatabaseBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Enseignant;

class ResultatManager extends BaseManager
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Resultat");
    }

    /**
     * @param Enseignant $enseignant
     * @param integer $limit
     * @param array $orderby
     * @return mixed
     */
    public function findByProf(Enseignant $enseignant, $limit = null, array $orderby = array())
    {
        /** @var QueryBuilder $query */
        $query = $this->repository->findByProf($enseignant->getId());
        if ($limit) {
            $query->setMaxResults($limit);
        }
        if (isset($orderby["champs"])) {
            if (isset($orderby["order"])) {
                $query->orderBy("r." . $orderby["champs"], $orderby["order"]);
            } else {
                $query->orderBy("r." . $orderby["champs"]);
            }
        }

        return $query->getQuery()->getResult();
    }

    public function findByEleve(Eleve $eleve, $limit = null, array $orderby = array()) {

        /** @var QueryBuilder $query */
        $query = $this->repository->findByEleve($eleve->getId());

        if ($limit) {
            $query->setMaxResults($limit);
        }
        if (isset($orderby["champs"])) {
            if (isset($orderby["order"])) {
                $query->orderBy("r." . $orderby["champs"], $orderby["order"]);
            } else {
                $query->orderBy("r." . $orderby["champs"]);
            }
        }

        return $query->getQuery()->getResult();
    }

} 