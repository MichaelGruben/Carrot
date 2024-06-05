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
}
