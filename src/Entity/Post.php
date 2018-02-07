<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * Post constructor.
     *
     * @param int       $id
     * @param string    $title
     * @param string    $content
     * @param \DateTime $createdAt
     * @param User      $author
     * @param Category  $category
     */
    public function __construct(int $id, string $title, string $content, \DateTime $createdAt, User $author, Category
    $category)
    {
        $this->id        = $id;
        $this->title     = $title;
        $this->content   = $content;
        $this->createdAt = $createdAt;
        $this->author    = $author;
        $this->category  = $category;

        $this->comments  = new ArrayCollection();
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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param PostComment $postComment
     */
    public function addComment(PostComment $postComment): void
    {
        $this->comments->add($postComment);
    }

    /**
     * @return ArrayCollection
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }
}
