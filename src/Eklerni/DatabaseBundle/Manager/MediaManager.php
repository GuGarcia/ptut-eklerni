<?php

namespace Eklerni\DatabaseBundle\Manager;

use Doctrine\ORM\EntityManager;

class MediaManager extends BaseManager
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository("EklerniDatabaseBundle:Media");
    }

    public function findByMedia($media)
    {
        return $this->repository->findByMedia($media)->getQuery()->getResult();
    }

    public function findAll()
    {
        return $this->repository->findAll()->getQuery()->getResult();
    }
} 