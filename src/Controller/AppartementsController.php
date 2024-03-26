<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\VisiteType;
use App\Repository\VisiterRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AppartementsRepository;
use App\Entity\Appartements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class AppartementsController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'AppartementsController',
            'title' => 'Accueil des appartements',
            'page' => 'appartements/index',
        ]);
    }

    public function visite(AppartementsRepository $AppartementsRepository, Request $request): Response {
        $Appartements = array();

        foreach ($AppartementsRepository->findAll() as $key => $value) {
            # code...
            $Appartements[$value->getId()] = array(
                'Arrondissement' => $value->getArrondissement(),
                'Code postal' => $value->getCodeville(),
                'Rue' => $value->getRue(),
                'Loyer' => $value->getLoyer(),
                'Type Appart' => $value->getTypappart(),
            );
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'AppartementsController',
            'title' => 'Visite des appartements',
            'page' => 'appartements/visite',
            'appartements' => $Appartements,
        ]);
    }

    public function visiteappart(
        Request $request,
        AppartementsRepository $appartementsRepository,
        VisiterRepository $visiterRepository,
        int $appartId,
        ): Response {
        $Appartement = $appartementsRepository->find($appartId);
        $Utilisateur = $request->getSession()->get("localuser");

        if(!isset($Appartement) || !isset($Utilisateur)){return $this->redirectToRoute("connexionpage");}
        
        $form = $this->createForm(VisiteType::class)
        ->add("submit",SubmitType::class);

        $form->handleRequest($request);
        $result = null;

        if ($form->isSubmitted() && $form->isValid()){
            $Visite = $form->getData();
            $Visite->setIdDem($Utilisateur->getLocataires());
            $result = $visiterRepository->addVisite($Visite);
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'AppartementsController',
            'title' => "Appartements n° $appartId",
            'page' => 'appartements/visite_display',
            'appartVisiteForm' => $form,
            "errorMessage" => $result,
        ]);
    }
}
