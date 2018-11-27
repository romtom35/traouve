<?php

namespace App\Repository;


use App\Entity\Category;
use App\Entity\County;
use App\Entity\State;
use App\Entity\Traobject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TraobjectRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Traobject::class);
    }

    public function findLastTraobjectByState(State $state, int $limit): array
    {
        $qb = $this->createQueryBuilder('t');

        $qb = $qb->select('t', 'c', 's')
            ->innerJoin('t.category', 'c')
            ->innerJoin('t.state', 's')
            ->where($qb->expr()->eq('s.id', ':state'))
            ->orderBy('t.createdAt', 'DESC');


        return $qb->setParameter(':state', $state->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findTraobjectByCategory(Category $category, State $state, int $limit): array
    {
        $qb = $this->createQueryBuilder('t');

        $qb = $qb->select('t', 'c', 's')
            ->innerJoin('t.category', 'c')
            ->innerJoin('t.state', 's')
            ->innerJoin('t.county', 'co')
            ->where($qb->expr()->eq('s.id', ':state'))
            ->andwhere($qb->expr()->eq('c.id', ':category'))
            ->orderBy('t.createdAt', 'DESC');


        return $qb->setParameter(':state', $state->getId())
            ->setParameter(':category', $category->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
    public function findTraobjectByCounty(County $county, State $state, int $limit): array
    {
        $qb = $this->createQueryBuilder('t');

        $qb = $qb->select('t', 'c', 's')
            ->innerJoin('t.category', 'c')
            ->innerJoin('t.state', 's')
            ->innerJoin('t.county', 'co')
            ->where($qb->expr()->eq('s.id', ':state'))
            ->andwhere($qb->expr()->eq('co.id', ':county'))
            ->orderBy('t.createdAt', 'DESC');


        return $qb->setParameter(':state', $state->getId())
            ->setParameter(':county', $county->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}