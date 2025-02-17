<?php

namespace App\Entity;

use App\Repository\ForumCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumCategoryRepository::class)]
class ForumCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, ForumSousCategory>
     */
    #[ORM\OneToMany(targetEntity: ForumSousCategory::class, mappedBy: 'forumCategory')]
    private Collection $Relation_Forum_SousForum;

    public function __construct()
    {
        $this->Relation_Forum_SousForum = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ForumSousCategory>
     */
    public function getRelationForumSousForum(): Collection
    {
        return $this->Relation_Forum_SousForum;
    }

    public function addRelationForumSousForum(ForumSousCategory $relationForumSousForum): static
    {
        if (!$this->Relation_Forum_SousForum->contains($relationForumSousForum)) {
            $this->Relation_Forum_SousForum->add($relationForumSousForum);
            $relationForumSousForum->setForumCategory($this);
        }

        return $this;
    }

    public function removeRelationForumSousForum(ForumSousCategory $relationForumSousForum): static
    {
        if ($this->Relation_Forum_SousForum->removeElement($relationForumSousForum)) {
            // set the owning side to null (unless already changed)
            if ($relationForumSousForum->getForumCategory() === $this) {
                $relationForumSousForum->setForumCategory(null);
            }
        }

        return $this;
    }
}
