<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\Candidature2Type;
use App\Repository\CandidatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidature/crud")
 */
class CandidatureCrudController extends AbstractController
{
    /**
     * @Route("/", name="candidature_crud_index", methods={"GET"})
     */
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('candidature_crud/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="candidature_crud_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(Candidature2Type::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidature);
            $entityManager->flush();

            return $this->redirectToRoute('candidature_crud_index');
        }

        return $this->render('candidature_crud/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_crud_show", methods={"GET"})
     */
    public function show(Candidature $candidature): Response
    {
        return $this->render('candidature_crud/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidature_crud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidature $candidature): Response
    {
        $form = $this->createForm(Candidature2Type::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidature_crud_index');
        }

        return $this->render('candidature_crud/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Candidature $candidature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidature_crud_index');
    }

    /**
     * @Route ("/changeretatconfirme/{id}",name="changeretatconfirme")
     */
    public function changeretatcomfirme($id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidature = $em->getRepository(Candidature::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
       
        $candidature -> setEtat('Confirmée');
        $entityManager->persist($candidature);
        $entityManager->flush();
        
        $etat = $em->getRepository(Candidature::class)->findAll();

        return $this->render('candidature_crud/show.html.twig', [
            'candidature' => $candidature,
        ]);
        
    }
    /**
     * @Route ("/changeretatrefuse/{id}",name="changeretatrefuse")
     */
    public function changeretatnonconfirme($id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidature = $em->getRepository(Candidature::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
       
        $candidature -> setEtat('Refusée');
        $entityManager->persist($candidature);
        $entityManager->flush();
        
        $etat = $em->getRepository(Candidature::class)->findAll();

        return $this->render('candidature_crud/show.html.twig', [
            'candidature' => $candidature,
        ]);
        
    }
}
