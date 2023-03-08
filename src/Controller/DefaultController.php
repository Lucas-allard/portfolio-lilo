<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
    ): Response
    {
        return $this->render('default/index.html.twig', [
            'user' => $userRepository->findOneBy(['firstName' => 'Lilo']),
            'projects' => $projectRepository->findAll(),
        ]);
    }
}
