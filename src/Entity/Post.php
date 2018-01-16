<?php

declare(strict_types=1);

namespace App\Entity;

class Post
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var string
     */
    private $author;
    /**
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
