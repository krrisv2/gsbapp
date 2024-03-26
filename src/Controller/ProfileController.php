<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Entity\Appartements;
use App\Form\AjoutAppartType;
use App\Form\LocataireInfoType;
use App\Form\ModifAppartType;

use App\Repository\AppartementsRepository;
use App\Repository\BanqueRepository;
use App\Repository\LocatairesRepository;
use App\Repository\ProprietairesRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{

    private function __checkType(Request $request,$type){
        $proprietaire = $request->getSession()->get("localuser");

        switch ($proprietaire) {
            case null:
                # code...
                return false;
            case !null:
                if($proprietaire->getType() == $type){
                    return true;
                }
                else{
                    return false;
                }
            default:
                # code...
                return false;
        }
    }

    public function index(
        Request $request,
        LocatairesRepository $Locataires,
        BanqueRepository $banqueRepository,
        ): Response
    {
        $Utilisateur = $request->getSession()->get("localuser");
        $errorMessage = null;

        if ($Utilisateur){
            $UserData = ["username" => $Utilisateur->getUsername()];
            $UserData["Type"] = $Utilisateur->getType();
            $form = null;

            if ($Utilisateur->getType() == 2){
                $form = $this->createForm(LocataireInfoType::class)
                
                ->add("banque", ChoiceType::class, [
                    "choices" => $banqueRepository->toChoices(),
                ])

                ->add("submit", SubmitType::class);

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()){
                    $locataireData = $form->getData();
                    print_r($locataireData);
                    $addedLocataire = $Locataires->updateLocataire($Utilisateur,$locataireData);

                    if ($addedLocataire){
                        $errorMessage = $addedLocataire;
                    }else{
                        $errorMessage = "Ajout réussi";
                    }
                }
            }

            return $this->render('index.html.twig', [
                'controller_name' => 'ConnexionController',
                'page' => 'profile/index',
                'title' => 'Page de connexion',
                'userData' => $UserData,
                'locataireform' => $form,
                'errorMessage' => $errorMessage
            ]);
        }else{
            return $this->redirectToRoute('connexionpage');
        }
    }

    public function logout(Request $request): Response
    {
        $request->getSession()->set("localuser", null);
        return $this->redirectToRoute("home");
    }

    public function gestion(Request $request,ProprietairesRepository $proprietairesRepository,AppartementsRepository $app_repo): Response 
    {
        if (!$this->__checkType($request,1)){return $this->redirectToRoute("profile");}

        $Utilisateur = $request->getSession()->get("localuser");

        $Proprietaire = $Utilisateur->getProprietaires();
        $Apparts = $Proprietaire->getAppartements();
        $newApparts = [];
        
        foreach ($Apparts as $key => $Appart) {
            # code...
            if (gettype($Appart) == 'array') {continue;}

            $newApparts[$Appart->getId()] = [
                "Numero" => $Appart->getNumappart(),
                "Type" => $Appart->getTypappart(),
                "Loyer" => $Appart->getLoyer(),
                "Emplacement" => $Appart->getEmplacement()
            ];
        }
        
        return $this->render('index.html.twig', [
            'page' => 'profile/gestionappart',
            'title' => 'Gestion des appartements',
            'userData' => $newApparts,
        ]);
    }

    public function modifappart(
        Request $request,
        ProprietairesRepository $proprietairesRepository,
        AppartementsRepository $app_repo,
        LocatairesRepository $locatairesRepository,
        UtilisateursRepository $utilisateursRepository,
        int $numappart
        )
        {
        if (!$this->__checkType($request,1)){return $this->redirectToRoute("profile");}

        $Utilisateur = $request->getSession()->get("localuser");

        $Proprietaire = $Utilisateur->getProprietaires();
        $Appart = null;

        foreach ($Proprietaire->getAppartements() as $key => $value) {
            # code..A.
            if ($value->getNumappart() == $numappart)
            {
                $Appart = $value; break;
            }
        }
        
        if(!isset($Appart)){return $this->redirectToRoute("profile");}

        $Locataires = $locatairesRepository->findAll();
        $choicesList = [];

        foreach ($Locataires as $key => $loc) {
            # code...
            if ($loc == null){continue;}
            
            $locataireId = $loc->getId();
            $utilLoc = $utilisateursRepository->find($loc->getIdUtil());
            $nom = $utilLoc->getNom();
            $prenom = $utilLoc->getPrenom();
    
            $choicesList["Locataires N° $locataireId($nom $prenom)"] = "$locataireId";
        }

        $form = $form = $this->createForm(ModifAppartType::class)

        ->add("idLoc", ChoiceType::class,[
            "choices" => $choicesList,
        ])

        ->add("submit", SubmitType::class) //
        ;

        $errorMessage = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $updatedAppart = $form->getData();
            $Appart->update($updatedAppart);
            $result = $app_repo->modifAppartement($Appart);

            if ($result){
                $errorMessage = $result;
            }else{
                $errorMessage = "Modification réussi.";
            }
        }

        return $this->render('index.html.twig', [
            'page' => 'profile/modifappart',
            'title' => "Modification d'un appartement",
            'Appart' => $Appart,
            'modif_form' => $form,
            'errorMessage' => $errorMessage
        ]);
    }

    public function ajout(
        Request $request,
        AppartementsRepository $appartementsRepository,
        ProprietairesRepository $proprietairesRepository
        ){
        if (!$this->__checkType($request,1)){return $this->redirectToRoute("profile");}

        $Utilisateur = $request->getSession()->get("localuser");
        $Proprietaire = $Utilisateur->getProprietaires();

        $form_appartements = $this->createForm(AjoutAppartType::class,)
        ->add("submit", SubmitType::class);
        $form_appartements->handleRequest($request);

        $errorMessage = null;

        if ($form_appartements->isSubmitted() && $form_appartements->isValid()){
            $Appart = $form_appartements->getData();
            $addResult = $appartementsRepository->ajouterAppart($Appart,$Proprietaire);

            if ($addResult){
                $errorMessage = $addResult;
            }else{
                $errorMessage = "Ajout réussise";
            }
        }

        return $this->render('index.html.twig', [
            'page' => 'profile/ajout',
            'title' => "Ajout d'un appartement",
            'form_appartements' => $form_appartements,
            'errorMessage' => $errorMessage
        ]);
    }
}
