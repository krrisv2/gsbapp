<?php

namespace App\Repository;

use App\Entity\BanqueLocataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BanqueLocataire>
 *
 * @method BanqueLocataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method BanqueLocataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method BanqueLocataire[]    findAll()
 * @method BanqueLocataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BanqueLocataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BanqueLocataire::class);
    }

    //    /**
    //     * @return BanqueLocataire[] Returns an array of BanqueLocataire objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BanqueLocataire
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
