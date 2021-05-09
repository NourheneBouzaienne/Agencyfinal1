<?php

namespace App\Controller;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Component\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, EntityManagerInterface $mamager): Response
    {   
        $utilisateur = new Utilisateur();
        $form = $this->createform(InscriptionType::class, $utilisateur);
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $mamager->persist($utilisateur);
            $mamager->flush();
        }
        return $this->render('admin_secu/inscription.html.twig',[ 
            'form' => $form->createView()
        ]);
    }
}
