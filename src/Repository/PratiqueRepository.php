<?php

namespace App\Repository;

use App\Entity\Pratique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pratique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pratique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pratique[]    findAll()
 * @method Pratique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PratiqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pratique::class);
    }

    // /**
    //  * @return Pratique[] Returns an array of Pratique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pratique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
