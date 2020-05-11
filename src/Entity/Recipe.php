<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="time")
     */
    private $bakingTime;

    /**
     * @ORM\Column(type="time")
     */
    private $preparationTime;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbPersonne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Difficulty", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $difficulty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="recipes")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeIngredient", mappedBy="recipe", orphanRemoval=true)
     */
    private $recipeIngredients;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="recipe", orphanRemoval=true)
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Step", mappedBy="recipe", orphanRemoval=true)
     */
    private $steps;
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->recipeIngredients = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->steps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null-
     */
    public function getBakingTime(): ?\DateTimeInterface
    {
        return $this->bakingTime;
    }

    public function getBakingTimeFormatted(): string
    {
        return $this->formatTime($this->getBakingTime());
    }


    public function setBakingTime(\DateTimeInterface $bakingTime): self
    {
        $this->bakingTime = $bakingTime;

        return $this;
    }

    public function getPreparationTime(): ?\DateTimeInterface
    {
        return $this->preparationTime;
    }

    public function getPreparationTimeFormatted(): string
    {
        //j'appelle ma methode et dans son parametre je mets getpreparationTime
        return $this->formatTime($this->getPreparationTime());
    }



    public function setPreparationTime(\DateTimeInterface $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(int $nbPersonne): self
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }


    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     * @return Collection|RecipeIngredient[]
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients[] = $recipeIngredient;
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if ($this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->removeElement($recipeIngredient);
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    private function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setRecipe($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getRecipe() === $this) {
                $photo->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Step[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->contains($step)) {
            $this->steps->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }
    //des qu'on va creer une nouvelle recette, il va remplir le champ avec la date automatiquement
    //grace à @ORM\HasLifecycleCallbacks() en haut (code que l'on va pouvoir exéctuter à un moment dans le code = hook en wordpress)
    //annotation ici = moment où cela va enregistrer
    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->setCreatedAt(new \DateTime());
    }

    //methode pour formater classes. Privée parce que pas de raison de la recuperer ailleurs que dans la classe
    private function formatTime(\DateTimeInterface $time): string
    {
        $hours = $time->format("G");
        $minutes = $time->format("i");
        $formattedTime = "";

        if ($hours > 0) {
            $formattedTime = "$hours heure" . (($hours > 1) ? "s" : "");
        }
        $formattedTime .= " ";
        if ($minutes > 0) {
            $formattedTime .= "$minutes minute" . (($minutes > 1) ? "s" : "");
        }

        return trim($formattedTime);
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }





}
