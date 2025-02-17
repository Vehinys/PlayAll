<?php

namespace App\Entity;

use App\Repository\ForumSousCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumSousCategoryRepository::class)]
class ForumSousCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Relation_Forum_SousForum')]
    private ?ForumCategory $forumCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getForumCategory(): ?ForumCategory
    {
        return $this->forumCategory;
    }

    public function setForumCategory(?ForumCategory $forumCategory): static
    {
        $this->forumCategory = $forumCategory;

        return $this;
    }
}
