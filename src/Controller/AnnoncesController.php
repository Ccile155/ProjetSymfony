<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Repository\AnnoncesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     */
    public function index(AnnoncesRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Annonces::class);
        $annonces = $repo->findAll();

        return $this->render('annonces/index.html.twig', [
            'annonces' => $annonces
        ]);
    }

    /**
     * @Route("/annonces/{id}", name="annonces/info")
     */
    public function uneSeuleAnnonce($id, AnnoncesRepository $repo)
    {
        $annonces = $repo->findOneById($id);

        return $this->render('annonces/index2.html.twig', [
            'annonce' => $annonces
        ]);
    }
}
