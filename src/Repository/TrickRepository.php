<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    // /**
    //  * @return Trick[] Returns an array of Trick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trick
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param $value
     * @return Trick[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByAuthor($value): array
    {
        return $this->findByAuthorIdQuery($value)
            ->getQuery()
            ->getResult()
            ;
    }

    public function find4ByAuthor($value): array
    {
        return $this->findByAuthorIdQuery($value)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }

        private function findByAuthorIdQuery($value) :QueryBuilder
        {
            return $this->createQueryBuilder('t')
                ->where('t.author_id = :val' )
                ->setParameter('val', $value);
        }
}
