<?php

namespace Eklerni\DatabaseBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Eklerni\DatabaseBundle\Entity\Activite;
use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Eklerni\DatabaseBundle\Entity\Matiere;
use Eklerni\DatabaseBundle\Entity\Resultat;
use Eklerni\DatabaseBundle\Entity\Serie;

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

    public function findByEleve(Eleve $eleve, $limit = null, array $orderby = array())
    {

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

    /**
     * @param array $condition
     * @param null $limit
     * @param array $orderby
     * @return array
     */
    public function findResults(array $condition = array(), $limit = null, array $orderby = array())
    {
        /** @var QueryBuilder $query */
        $query = $this->repository->createQueryBuilder("r");

        /**
         * SELECT
         */
        if (isset($condition["moyenne"]) && count($condition["moyenne"])) {
            $query->select("r, avg(r.note) as note");
        } else {
            $query->select("r");
        }

        /**
         * JOIN
         */
        /** @var Serie $serie */
        if (isset($condition["serie"]) && $serie = $condition['serie']) {
            $query->innerJoin("r.serie", "s")
                ->andWhere("s.id = :idserie")
                ->setParameter("idserie", $serie->getId());
        }

        /** @var Eleve $eleve */
        if (isset($condition["eleve"]) && $eleve = $condition['eleve']) {
            $query->innerJoin("r.eleve", "e")
                ->andWhere("e.id = :ideleve")
                ->setParameter("ideleve", $eleve->getId());
        }

        /** @var Classe $classe */
        if (isset($condition["classe"]) && $classe = $condition['classe']) {
            if (!isset($condition["eleve"])) {
                $query->innerJoin("r.eleve", "e");
            }
            $query->innerJoin("e.classe", "c")
                ->andWhere("c.id = :idclasse")
                ->setParameter("idclasse", $classe->getId());
        }

        /** @var Activite $activite */
        if (isset($condition["activite"]) && $activite = $condition['activite']) {
            if (!isset($condition["serie"])) {
                $query->innerJoin("r.serie", "s");
            }
            $query->innerJoin("s.activite", "a")
                ->andwhere("a.id = :idactivite")
                ->setParameter("idactivite", $activite->getId());
        }

        /** @var Matiere $matiere */
        if (isset($condition["matiere"]) && $matiere = $condition['matiere']) {
            if (!isset($condition["serie"]) && !isset($condition["activite"])) {
                $query->innerJoin("r.serie", "s");
            }
            if (!isset($condition["activite"])) {
                $query->innerJoin("s.activite", "a");
            }
            $query->innerJoin("a.matiere", "m")
                ->andwhere("m.id = :idmatiere")
                ->setParameter("idmatiere", $matiere->getId());
        }

        /** @var Enseignant $enseignant */
        if (isset($condition["enseignant"]) && $enseignant = $condition['enseignant']) {
            if (!isset($condition["serie"]) && !isset($condition["activite"]) && !isset($condition["matiere"])) {
                $query->innerJoin("r.serie", "s");
            }
            $query->innerJoin("s.enseignant", "p")
                ->andWhere("p.id = :idenseignant")
                ->setParameter("idenseignant", $enseignant->getId());
        }

        /**
         * GROUP BY
         */
        if (isset($condition["moyenne"]) && $condition["moyenne"] == "eleve") {
            if (!isset($condition["eleve"]) && !isset($condition["classe"])) {
                $query->innerJoin("r.eleve", "e");
            }
            if (!isset($condition["classe"])) {
                $query->innerJoin("e.classe", "c");
            }
            $query->groupBy("e.id");
        } else if (isset($condition["moyenne"]) && $condition["moyenne"] == "classe") {
            if (!isset($condition["eleve"]) && !isset($condition["classe"])) {
                $query->innerJoin("r.eleve", "e");
            }
            if (!isset($condition["classe"])) {
                $query->innerJoin("e.classe", "c");
            }
            $query->groupBy("c.id");
        } else if (isset($condition["moyenne"]) && $condition["moyenne"] == "matiere") {
            if (!isset($condition["serie"]) && !isset($condition["activite"])) {
                $query->innerJoin("r.serie", "s");
            }
            if (!isset($condition["activite"])) {
                $query->innerJoin("s.activite", "a");
            }
            if (!isset($condition["matiere"])) {
                $query->innerJoin("a.matiere", "m");
            }
            $query->groupBy("m.id");
        }

        if(isset($condition["istest"]) && count($condition["istest"])) {
            $query->andwhere("r.isTest = :istest")
                ->setParameter("istest", ($condition["istest"] == "false")?false:true);
        }

        if ($limit) {
            $query->setMaxResults($limit);
        }
        if (isset($orderby["champs"])) {
            if (isset($orderby["order"])) {
                $query->orderBy( $orderby["champs"], $orderby["order"]);
            } else {
                $query->orderBy( $orderby["champs"]);
            }
        }

        return $query->getQuery()->getResult();
    }

} 