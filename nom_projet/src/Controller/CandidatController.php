<?php

namespace App\Controller;

use App\Repository\CandidatRepository;
use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatController extends AbstractController
{
    /**
     * @Route("/candidat", name="candidat")
     */
    public function index(CandidatRepository $repository): Response
    {
        $candidats = $repository->findall();
        return $this->render('candidat/index.html.twig', [
            'candidats'=>$candidats
        ]);
    }

   /**
     * @Route("/candidat/postuler", name="offre_emploi_postuler")
     */
    public function showoffre(OffreEmploiRepository $repository): Response
    {
        $offres=$repository->findall();
        return $this->render('candidat/showoffre.html.twig', [
           'offres'=>$offres
        ]);
    }
}
