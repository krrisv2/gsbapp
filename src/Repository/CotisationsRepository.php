<?php

namespace App\Repository;

use App\Entity\Cotisations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cotisations>
 *
 * @method Cotisations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cotisations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cotisations[]    findAll()
 * @method Cotisations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CotisationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cotisations::class);
    }

    //    /**
    //     * @return Cotisations[] Returns an array of Cotisations objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cotisations
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
