<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(CategorieRepository $repository): Response
    {   
        $categories = $repository->findall();
        return $this->render('categorie/index.html.twig', [
            'categories'=>$categories
        ]);
    }

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
}
