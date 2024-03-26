<?php

namespace App\Repository;

use App\Entity\Demandeurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Demandeurs>
 *
 * @method Demandeurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demandeurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demandeurs[]    findAll()
 * @method Demandeurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demandeurs::class);
    }

    //    /**
    //     * @return Demandeurs[] Returns an array of Demandeurs objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Demandeurs
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
