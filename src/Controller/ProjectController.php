<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Entity\Project;
use App\Form\PriorityType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'project')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/project/create', name: 'create_project')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response {

        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $project->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($project);
            $entityManager->flush();


            return $this->redirectToRoute('project');
        }

        $formView = $form->createView();
        return $this->render('project/project_create.html.twig', [
            'formView' => $formView,
        ]);
    }
}
