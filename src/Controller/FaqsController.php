<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqsController extends AbstractController
{
    #[Route('/faqs', name: 'faqs')]
    public function index(): Response
    {
        return $this->render('faqs/index.html.twig', [
            'controller_name' => 'FaqsController',
        ]);
    }
}
