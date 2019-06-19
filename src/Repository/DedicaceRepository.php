<?php

namespace App\Repository;

use App\Entity\Dedicace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dedicace|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dedicace|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dedicace[]    findAll()
 * @method Dedicace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DedicaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dedicace::class);
    }

    // /**
    //  * @return Dedicace[] Returns an array of Dedicace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dedicace
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
