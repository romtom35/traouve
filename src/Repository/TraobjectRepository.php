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

    public function findLastTraobjectBy(int $limit, Category $category = null, State $state = null , County $county = null ): array
    {
        $qb = $this->createQueryBuilder('t');

        $qb = $qb->select('t', 'c', 's')
            ->innerJoin('t.category', 'c')
            ->innerJoin('t.state', 's')
            ->innerJoin('t.county', 'co');

        if ($state != null) {
            $qb = $qb->andWhere($qb->expr()->eq('s.id', ':state'))
                ->setParameter(':state', $state->getId());
        }
        if ($category != null) {
            $qb = $qb->andWhere($qb->expr()->eq('c.id', ':category'))
                ->setParameter(':category', $category->getId());
        }
        if ($county != null) {
            $qb = $qb->andWhere($qb->expr()->eq('co.id', ':county'))
                ->setParameter(':county', $county->getId());
        }
        $qb = $qb->orderBy('t.createdAt', 'DESC');
        return $qb->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


}