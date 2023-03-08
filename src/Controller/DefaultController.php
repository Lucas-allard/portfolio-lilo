<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        UserRepository    $userRepository,
        ProjectRepository $projectRepository,
    ): Response
    {
        return $this->render('default/index.html.twig', [
            'user' => $userRepository->findOneBy(['firstName' => 'Lilo']),
            'projects' => $projectRepository->findAll(),
        ]);
    }

    #[Route('/projets', name: 'projects', requirements: ['category' => '\w+'])]
    public function getProjects(
        Request            $request,
        ProjectRepository  $projectRepository,
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator,
    ): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $request->get('category')]);


        if ($category !== null) {
            $projects = $projectRepository->findByCategory($category);
        }

        $paginatedProjects = $paginator->paginate(
            $projects ?? $projectRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('default/projets.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'projects' => $paginatedProjects,
        ]);
    }

    #[Route('/projets/{slug}', name: 'project')]
    public function getProject(
        string             $slug,
        ProjectRepository  $projectRepository,
        CategoryRepository $categoryRepository,
    ): Response
    {
        return $this->render('default/projet.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'project' => $projectRepository->findOneBy(['slug' => $slug]),
        ]);
    }
}
