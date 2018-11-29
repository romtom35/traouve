<?php

namespace App\Repository;


use App\Entity\Comment;
use App\Entity\Traobject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CommentRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findByTraobject(Traobject $traobject): array
    {
        $qb = $this->createQueryBuilder('c');

        $qb = $qb->select('c', 't', 'u')
            ->innerJoin('c.traobject', 't')
            ->innerJoin('c.user', 'u')
            ->where($qb->expr()->eq('t.id', ':traobject'))
            ->orderBy('c.createdAt', 'DESC');

        return $qb->setParameter(':traobject', $traobject->getId())->getQuery()->getResult();
    }
}