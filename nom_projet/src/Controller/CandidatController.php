<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;

use App\Entity\RechercheCondidat;
use App\Form\RechercheCondidatType;
use App\Repository\CandidatRepository;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatController extends AbstractController
{
    /**
     * @Route("/candidat", name="candidat")
     */
    public function index(CandidatRepository $repository ,PaginatorInterface $paginatorInterface, Request $req): Response
    {
        $rechercheCondidat = new RechercheCondidat();
        $form = $this->createForm(RechercheCondidatType::class,$rechercheCondidat);
        $form-> handleRequest($req);
       
        $candidats = $paginatorInterface->paginate(
            $repository->findAllWithPagination($rechercheCondidat),
            $req->query->getInt('page',1),6
        );
        return $this->render('candidat/index.html.twig', [
            'candidats'=>$candidats,
            'form'=>$form->createView()
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
