<?php

namespace App\Controller;

use App\Entity\Locataires;
use App\Entity\Proprietaires;
use App\Entity\Utilisateurs;
use App\Form\InscriptionType;
use App\Form\LocataireInfoType;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConnexionController extends AbstractController
{
    public function index(Request $request,UtilisateursRepository $Utilisateurs): Response
    {
        $session= $request->getSession();

        if ($session->get('localuser')){
            return $this->redirectToRoute("profile");
        }

        $errorMessage = "";

        //$Utilisateur = new Utilisateurs;
        $form = $this->createFormBuilder([
            "username",
            "motdepasse",
            ])
        ->add("username", TextType::class)
        ->add("motdepasse", PasswordType::class)
        ->add("submit", SubmitType::class)
        ->setAction("/connexion")
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;
            $formData = $form->getData();
            $username = $formData['username'];
            $motdepasse = $formData['motdepasse'];

            $Utilisateur = $Utilisateurs->ConnectTo($username,$motdepasse);

            if (isset($Utilisateur)) 
            {
                $request->getSession()->set("localuser",$Utilisateur);

              return $this->redirectToRoute("profile");
            }
            else{
                $errorMessage = "Nom d'utilisateur ou mot de passe incorrect";
            }
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'ConnexionController',
            'page' => 'connexion/index',
            'title' => 'Page de connexion',
            'form' => $form,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function inscription(Request $request,UtilisateursRepository $Utilisateurs,ValidatorInterface $validatorInterface,$type): Response{
        $errorMessage = null;
        $form = $this->createForm(InscriptionType::class);

        $form->add("submit",SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newUtilisateur = $form->getData();
            $signInResult = $Utilisateurs->SignIn($newUtilisateur,$form,$validatorInterface);

            if (!$signInResult) {
                $request->getSession()->set("localuser",$newUtilisateur);
                return $this->redirectToRoute("profile");
            }else{
                $errorMessage = "Erreur dans l'inscription :";

                $ERRORS_MESSSAGES = [
                    "SQLSTATE[23000]" => "Utilisateur déja inscrit"
                ];

                foreach($ERRORS_MESSSAGES as $keyError => $messageError){
                    if (str_contains($signInResult,"SQLSTATE[23000]")){
                        $errorMessage .= $messageError;
                        break;
                    }
                }
            }
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'ConnexionController',
            'page' => 'connexion/inscription',
            'title' => 'Inscriptions',
            'form' => $form,
            "errorMessage" => $errorMessage
        ]);
    }

    public function connexion() {

    }
}
