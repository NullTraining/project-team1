<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostCommentRepository")
 * @ORM\Table(name="post_comments")
 */
class PostComment
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=250)
     */
    private $comment;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $user;

    /** @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $timestamp;

    public function __construct()
    {
        $this->timestamp = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @throws \InvalidArgumentException
     */
    public function setComment(string $comment): void
    {
        if ('' === $comment) {
            throw new \InvalidArgumentException('Post Comment cannot be empty.', 0);
        }

        $this->comment = $comment;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param \App\Entity\Post $post
     */
    public function setPost(\App\Entity\Post $post): void
    {
        $this->post = $post;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param \App\Entity\User $user
     */
    public function setUser(\App\Entity\User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }
}
