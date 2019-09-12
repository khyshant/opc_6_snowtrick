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

    //return is typed as an array of tricks for helping my IDE  to use completion

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

    /**
     * @param $value
     * @param $number
     * @return Trick[]
     */
    public function findXByAuthor($value, $number): array
    {
        return $this->findByAuthorIdQuery($value)
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
            ;
    }
        //code commun au différente methode de findbyauthor
        private function findByAuthorIdQuery($value) :QueryBuilder
        {
            return $this->createQueryBuilder('t')
                ->where('t.author_id = :val' )
                ->setParameter('val', $value);
        }
}
