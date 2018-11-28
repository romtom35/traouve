<?php

namespace App\Repository;


use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CommentRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findLast(int $limit): array
    {
        $qb = $this->createQueryBuilder('c');

        $qb = $qb->select('c', 't', 'u')
            ->innerJoin('c.traobject', 't')
            ->innerJoin('c.user', 'u')
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
}