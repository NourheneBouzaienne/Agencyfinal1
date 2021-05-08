<?php

namespace App\Controller;

use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OffreEmploiController extends AbstractController
{
    /**
     * @Route("/offre_emploi", name="offre_emploi")
     */
    public function index(OffreEmploiRepository $repository): Response
    {
        $offres=$repository->findall();
        return $this->render('offre_emploi/index.html.twig', [
           'offres'=>$offres
        ]);
    }
}
