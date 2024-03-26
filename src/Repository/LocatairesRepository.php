<?php

namespace App\Repository;

use App\Entity\Locataires;
use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Locataires>
 *
 * @method Locataires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locataires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locataires[]    findAll()
 * @method Locataires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocatairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locataires::class);
    }

    public function updateLocataire(Utilisateurs $Utilisateur,Locataires $Locataire){
        try{
            $foundLocataire = null;

            foreach ($this->findAll() as $key => $loca) {
                # code...
                if ($loca->getIdUtil() == $Utilisateur->getId()){
                    $foundLocataire = $loca;
                    $foundLocataire->update($Locataire);
                    break;
                }
            }

            if (!$foundLocataire){
                $Locataire->setIdUtil($Utilisateur);
                $this->getEntityManager()->persist($Locataire);
            }
 
            $this->getEntityManager()->flush();

            return false;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function findAllWithIdUtil($value){
        $array__ = [];

        foreach ($this->findAll() as $key => $Locataire){
            if($value == $Locataire->getIdUtil()){
                $array__[] = $Locataire;
            }
        }

        return $array__;
    }

    //    /**
    //     * @return Locataires[] Returns an array of Locataires objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Locataires
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
