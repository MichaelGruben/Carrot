<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'categories')]
class Category
{
    /**
     * - Nudelgericht
     * - Kartoffelgericht
     * - Reisgericht
     * - Teiggericht
     * - Suppe/Eintopf
     * - Sonstiges
     */
    /** @var int */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id = null;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $name;

    /** @var Collection<int, Recipe> An ArrayCollection of Recipe objects. */
    #[ORM\OneToMany(targetEntity: Recipe::class, mappedBy: 'recipe')]
    private Collection $assignedRecipes;

    public function assignRecipe(Recipe $recipe)
    {
        $this->assignedRecipes[] = $recipe;
    }

}