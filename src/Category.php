<?php

use Doctrine\ORM\Mapping as ORM;

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

}