<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    /** @var int */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id = null;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $username;
    /** @var string */
    #[ORM\Column(type: 'string', unique: true)]
    private $email;
    /** @var string */
    #[ORM\Column(type: 'string')]
    private $passwordHash;

    /** @var Collection<int, Recipe> An ArrayCollection of Recipe objects. */
    #[ORM\OneToMany(targetEntity: Recipe::class, mappedBy: 'owner')]
    private Collection $ownedRecipes;

    public function __construct()
    {
        $this->ownedRecipes = new ArrayCollection();
    }

    public function toUsername(): string
    {
        return $this->username;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function authenticate(string $password, callable $checkHash): bool
    {
        return $checkHash($password, $this->passwordHash);
    }

    public function changePassword(string $password, callable $hash): void
    {
        $this->passwordHash = $hash($password);
    }

    public function addOwnedRecipe(Recipe $recipe)
    {
        $this->ownedRecipes[] = $recipe;
    }
}
