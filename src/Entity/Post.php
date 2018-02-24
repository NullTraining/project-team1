<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @var string
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var bool
     */
    private $archived;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var bool
     */
    private $active;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     *
     * @var User
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="posts", cascade={"persist"})
     *
     * @var Category
     */
    private $category;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PostComment", mappedBy="post", cascade={"persist"})
     */
    private $comments;

    public function __construct()
    {
        $this->archived   = false;
        $this->active     = true;
        $this->comments   = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \App\Entity\User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param \App\Entity\User $author
     */
    public function setAuthor(\App\Entity\User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return \App\Entity\Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param \App\Entity\Category $category
     */
    public function setCategory(\App\Entity\Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @param PostComment $postComment
     */
    public function addComment(PostComment $postComment): void
    {
        $this->comments->add($postComment);
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function archive()
    {
        $this->archived = true;
        $this->active   = false;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    public function activate()
    {
        $this->active   = true;
        $this->archived = false;
    }

    public function deactivate()
    {
        $this->active = false;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
