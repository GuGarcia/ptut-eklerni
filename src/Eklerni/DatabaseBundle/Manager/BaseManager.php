<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Eklerni\DatabaseBundle\Entity\BaseEntity;
use Eklerni\DatabaseBundle\Entity\Enseignant;

abstract class BaseManager implements CASManagerInterface
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
    }

    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    /**
     * Save Entity in database
     * @param BaseEntity $entity
     */
    public function save(BaseEntity $entity)
    {
        if (property_exists($entity, 'dateModification')) {
            $entity->setDateModification(new \DateTime('now'));
        }

        if (null === $entity->getId()) {
            if (property_exists($entity, 'dateCreation')) {
                $entity->setDateCreation(new \DateTime('now'));
            }
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->repository->findAll()->getQuery()->getResult();
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->repository->findOneBy(array("id" => $id));
    }

    /**
     * @param Enseignant $enseignant
     * @return mixed
     */
    public function findByProf(Enseignant $enseignant)
    {
        return $this->repository->findByProf($enseignant->getId())->getQuery()->getResult();
    }

} 