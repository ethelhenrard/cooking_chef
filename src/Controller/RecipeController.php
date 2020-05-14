<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// prefix qui sera mis devant toutes les routes de ce controller
/**
 * @Route("/recipe")
 */
class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipe_index", methods={"GET"})
     */

    public function index(RecipeRepository $recipeRepository): Response
    {
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findAll(),
        ]);
    }

    //il faut etre authentifier pour acceder au new
    //ou possible de mettre $this->>deniedAccessGranteddans methode
    /**
     * @Route("/new", name="recipe_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    // injection de dependance/service en rajoutant parametre FileUploader
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form['pictureFile']->getData();
            if ($pictureFile) {
                $pictureFilename = $fileUploader->upload($pictureFile);
                $recipe->setPicture($pictureFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $recipe->setUser($this->getUser()); // Associer la recette à l'utilisateur connecté
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="recipe_show", methods={"GET"})
     */
    public function show(Recipe $recipe): Response
    {
        //$this->getDoctrine->getRepository($classname::class)->findOneById($id);
        // si on voulait mettre un slug dans l'url à la place id, il faudrait créer propriété slug dans l'entity
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,


        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipe_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        //verifier si l'utilisateur connecté est admin ou si c'est lui qui a créé la recette

        if (!$this->isGranted("ROLE_ADMIN") && $this->getUser() !== $recipe->getUser()) {
            throw $this->createAccessDeniedException("Vous n'avez pas le droit de modifier cette recette");
        }

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        // Vérifier si l'utilisateur connecté est admin ou si c'est lui qui a créé la recette
        if (!$this->isGranted("ROLE_ADMIN") && $this->getUser() !== $recipe->getUser()) {
            throw $this->createAccessDeniedException("Vous n'avez pas le droit de supprimer cette recette");
        }

        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_index');
    }
}
