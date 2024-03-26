<?php

namespace App\Repository;

use App\Entity\Appartements;
use App\Entity\Locataires;
use App\Entity\Proprietaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Appartements>
 *
 * @method Appartements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appartements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appartements[]    findAll()
 * @method Appartements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appartements::class);
    }

    public function modifAppartement(Appartements $Appartement){
        try {
            $this->getEntityManager()->flush();
            return false;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function ajouterAppart(Appartements $Appartement, Proprietaires $Proprietaire){
        try {
            $message = null;

            foreach($this->findAll() as $key => $Appart){
                $numero = $Appart->getNumappart();

                if ($numero == $Appartement->getNumappart() && $Appart->getidPro() == $Appartement->getidPro()){
                    return "Numéro ($numero) déjà attribué.";
                }
            }
            //print_r($Appartement);

           
            //$Appartement->setIdLoc(new Locataires);
            $Proprietaire->addAppartement($Appartement);
            $this->getEntityManager()->persist($Appartement);
            $this->getEntityManager()->flush();
            return false;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    //    /**
    //     * @return Appartements[] Returns an array of Appartements objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Appartements
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
