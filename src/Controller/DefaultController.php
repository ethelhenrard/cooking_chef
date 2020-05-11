<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $em = $this->getDoctrine();

        $recipes = $em->getRepository(Recipe::class)->findAll();


        return $this->render("default/index.html.twig", [
            "recipes" =>$recipes,
        ]);
    }

    public function searchFor(CategoryRepository $categoryRepository)
    {
        return $this->render("default/_search_form.html.twig", [
            "categories" => $categoryRepository->findAll()
        ]);

    }

}
