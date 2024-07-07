<?php

use Doctrine\ORM\Mapping as ORM;

enum Effort: string {
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}

#[ORM\Entity]
#[ORM\Table(name: 'recipes')]
class Recipe
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string', enumType: Effort::class)]
    private Effort $effort;

    private User $owner;
    private Category $category;

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setEffort(string $effort) {
        $this->effort = $effort;
    }

    public function assignCategory(Category $category) {
        $category->assignRecipe($this);
        $this->category = $category;
    }

    public function setOwner(User $owner): void {
        $owner->addOwnedRecipe($this);
        $this->owner = $owner;
    }
}
