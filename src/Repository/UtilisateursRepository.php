<?php

namespace App\Repository;

use App\Entity\Locataires;
use App\Entity\Proprietaires;
use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @extends ServiceEntityRepository<Utilisateurs>
 *
 * @method Utilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateurs[]    findAll()
 * @method Utilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateurs::class);
    }
    
    private function Crypt($value){
        $salt = "saltkris";

        return crypt($value, $salt);
    }

    public function ConnectTo($username, $motdepasse):Utilisateurs|null{
        foreach ($this->findAll() as $key => $_utilisateur) {
            # code...
            if($_utilisateur->getUsername() == $username && $_utilisateur->getMotdepasse() == $this->Crypt($motdepasse)){
                return $_utilisateur;
            }
        }

        return null;
    }

    public function SignIn(Utilisateurs $newUtilisateur,FormInterface $form,ValidatorInterface $validatorInterface) {
        $username = $newUtilisateur->getUsername();
        $motdepasse = $this->Crypt($newUtilisateur->getMotdepasse());

        try {
           $newUtilisateur->setMotdepasse($motdepasse);
           
           $this->getEntityManager()->persist($newUtilisateur);
           $this->getEntityManager()->flush();

           if ($newUtilisateur->getType() == 1){
                $newProprietaire = new Proprietaires;
                $newProprietaire->setIdUtil($newUtilisateur);
                $this->getEntityManager()->persist($newProprietaire);
                $this->getEntityManager()->flush();
            }

           $errors = $validatorInterface->validate($newUtilisateur);

            return false;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    //    /**
    //     * @return Utilisateurs[] Returns an array of Utilisateurs objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Utilisateurs
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
