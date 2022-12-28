<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/tableau-de-bord')]
class UserDashboardController extends AbstractController
{
    #[Route('/', name: 'user_dashboard')]
    public function index(UserRepository $userRepository): Response
    {
        $affiliers = $userRepository->findBy(['parrain' => $this->getUser()]);

        return $this->render('user/user_dashboard/index.html.twig', [
            'controller_name' => 'UserDashboardController',
            'affiliers' => $affiliers,
        ]);
    }
}
