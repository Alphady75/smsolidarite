<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/affiliers')]
class UserAffiliersController extends AbstractController
{
    private UrlHelper $urlHelper;

    public function __construct(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    #[Route('/', name: 'user_affiliers')]
    public function index(UserRepository $userRepository): Response
    {
        $affiliers = $userRepository->findBy(['parrain' => $this->getUser()]);

        return $this->render('user/user_affiliers/index.html.twig', [
            'affiliers' => $affiliers,
            'parrainageLink' => $this->urlHelper->getAbsoluteUrl('/parrainage/parrain_id=' . $this->getUser()->getId()),
        ]);
    }
}
