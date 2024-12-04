<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Form\PriorityType;
use App\Repository\PriorityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PriorityController extends AbstractController
{
    #[Route('/priority', name: 'priority')]
    public function index(PriorityRepository $priorityRepository): Response
    {
        $prioritys = $priorityRepository->findAll();

        return $this->render('priority/index.html.twig', [
            'prioritys' => $prioritys,
        ]);
    }

    #[Route('/priority/create', name: 'create_priority')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response {

        $priority = new Priority();

        $form = $this->createForm(PriorityType::class, $priority);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($priority);
            $entityManager->flush();

            return $this->redirectToRoute('priority');
        }

        $formView = $form->createView();

        return $this->render('priority/priority_create.html.twig', [
            'formView' => $formView,
        ]);
    }
}
