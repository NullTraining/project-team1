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
     *
     * @var string
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
     * @param string    $category
     */
    public function __construct(int $id, string $title, string $content, \DateTime $createdAt, string $author, string $category)
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
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}
