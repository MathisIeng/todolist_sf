<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Form\StatutType;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatutController extends AbstractController
{
    #[Route('/statut', name: 'statut')]
    public function index(StatutRepository $statutRepository): Response
    {
        $statuts = $statutRepository->findAll();

        return $this->render('statut/index.html.twig', [
            'statuts' => $statuts,
        ]);
    }

    #[Route('/statut/create', name: 'create_statut')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response {

        $statut = new Statut();
        $form = $this->createForm(StatutType::class, $statut);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $entityManager->persist($statut);
            $entityManager->flush();

            return $this->redirectToRoute('statut');
        }

        $formView = $form->createView();

        return $this->render('statut/statut_create.html.twig', compact('formView'));
    }
}
