<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\Categorie1Type;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie/crud")
 */
class CategorieCrudController extends AbstractController
{

     /**
     * @Route("/categorie/{id}", name="categorie_id")
     */
    public function index_id(CategorieRepository $repository,$id): Response
    {   
        $categories = $repository->find($id);
        return $this->render('categorie/index_parcategorie.html.twig', [
            'categories'=>$categories
        ]);
    }


    /**
     * @Route("/", name="categorie_crud_index")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie_crud/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    } 

    /**
     * @Route("/new", name="categorie_crud_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(Categorie1Type::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_crud_index');
        }

        return $this->render('categorie_crud/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_crud_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie_crud/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_crud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(Categorie1Type::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_crud_index');
        }

        return $this->render('categorie_crud/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_crud_index');
    }

    public function configureFields(string $pageName): iterable {
        $offres=CollectionField::new('offres','Offres')
            ->allowAdd() 
            ->allowDelete()
            ->setEntryIsComplex(true)
            ->setEntryType(CategorieCrudController::class)
        ->setFormTypeOptions([
            'by_reference' => 'false'                     
                ]);
            }
}