<?php

declare(strict_types=1);

namespace App\Entity;

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
     * @var boolean
     */
    private $archived;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     *
     * @var string
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=50, nullable=false))
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="posts")
     *
     * @var Category
     */
    private $category;

    /**
     * Post constructor.
     *
     * @param int       $id
     * @param string    $title
     * @param string    $content
     * @param \DateTime $createdAt
     * @param string    $author
     * @param Category  $category
     */
    public function __construct(int $id, string $title, string $content, \DateTime $createdAt, string $author, Category
    $category)
    {
        $this->id        = $id;
        $this->title     = $title;
        $this->content   = $content;
        $this->createdAt = $createdAt;
        $this->author    = $author;
        $this->category  = $category;
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
    public function getAuthor(): string
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

    public function archive()
    {
        $this->archived = true;
    }

    public function isArchived()
    {
        return $this->archived;
    }
}
