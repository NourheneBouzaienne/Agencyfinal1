<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\Rdv1Type;
use App\Repository\RdvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rdv/crud")
 */
class RdvCrudController extends AbstractController
{
    /**
     * @Route("/", name="rdv_crud_index", methods={"GET"})
     */
    public function index(RdvRepository $rdvRepository): Response
    {
        return $this->render('rdv_crud/index.html.twig', [
            'rdvs' => $rdvRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rdv_crud_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rdv = new Rdv();
        $form = $this->createForm(Rdv1Type::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rdv);
            $entityManager->flush();

            return $this->redirectToRoute('rdv_crud_index');
        }

        return $this->render('rdv_crud/new.html.twig', [
            'rdv' => $rdv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rdv_crud_show", methods={"GET"})
     */
    public function show(Rdv $rdv): Response
    {
        return $this->render('rdv_crud/show.html.twig', [
            'rdv' => $rdv,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rdv_crud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rdv $rdv): Response
    {
        $form = $this->createForm(Rdv1Type::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rdv_crud_index');
        }

        return $this->render('rdv_crud/edit.html.twig', [
            'rdv' => $rdv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rdv_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Rdv $rdv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rdv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rdv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rdv_crud_index');
    }
}
