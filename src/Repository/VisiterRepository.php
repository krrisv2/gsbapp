<?php

namespace App\Repository;

use App\Entity\Visiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visiter>
 *
 * @method Visiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiter[]    findAll()
 * @method Visiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visiter::class);
    }

    public function addVisite(Visiter $Visite){
       try {
        $VisiteformattedTime = $Visite->getDATEVISITE();   

        //print_r($Visite->getIdDem());

        foreach ($this->findAll() as $key => $_visite) {
            # code...

            $formattedTime = strtotime($_visite->getDATEVISITE());
            $diffTime = strtotime($Visite->getDATEVISITE()->format('Y-m-d H:i:s'));

            $result = $diffTime -  $formattedTime ;
            echo $result;
        }

        $Visite->setDATEVISITE($VisiteformattedTime->format("Y-m-d H:i:s"));
        $this->getEntityManager()->persist($Visite);
        $this->getEntityManager()->flush();

        $Date = $Visite->getDATEVISITE();

        return "Visite prise pour le  $Date";
       }catch(\Exception $e){
        return $e->getMessage();
       }
    }


    //    /**
    //     * @return Visiter[] Returns an array of Visiter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Visiter
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
