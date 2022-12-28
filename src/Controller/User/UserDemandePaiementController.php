<?php

namespace App\Controller\User;

use App\Entity\DemandePaiement;
use App\Form\DemandePaiementType;
use App\Repository\DemandePaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/demande/paiement')]
class UserDemandePaiementController extends AbstractController
{
    #[Route('/', name: 'user_demande_paiement_index', methods: ['GET'])]
    public function index(DemandePaiementRepository $demandePaiementRepository): Response
    {
        return $this->render('user/user_demande_paiement/index.html.twig', [
            'demande_paiements' => $demandePaiementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'user_demande_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandePaiement = new DemandePaiement();
        $form = $this->createForm(DemandePaiementType::class, $demandePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $demandePaiement->setStatut(false);
            $demandePaiement->setUser($this->getUser());
            $entityManager->persist($demandePaiement);
            $entityManager->flush();

            $this->addFlash('success', 'Votre demmande a bien été envoyée');

            return $this->redirectToRoute('user_demande_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/user_demande_paiement/new.html.twig', [
            'demande_paiement' => $demandePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_demande_paiement_show', methods: ['GET'])]
    public function show(DemandePaiement $demandePaiement): Response
    {
        return $this->render('user/user_demande_paiement/show.html.twig', [
            'demande_paiement' => $demandePaiement,
        ]);
    }

    #[Route('/{id}/edit', name: 'user_demande_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandePaiement $demandePaiement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandePaiementType::class, $demandePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_demande_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/user_demande_paiement/edit.html.twig', [
            'demande_paiement' => $demandePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_demande_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, DemandePaiement $demandePaiement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandePaiement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($demandePaiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_demande_paiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
