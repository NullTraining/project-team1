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

    /** @var \DateTime $timestamp */
    private $timestamp;

    /**
     * PostComment constructor.
     *
     * Comment must be a non-empty string.
     *
     * @param int    $id
     * @param string $comment
     * @param Post   $post
     * @param User   $user
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(int $id, string $comment, Post $post, User $user)
    {
        if ('' === $comment) {
            throw new \InvalidArgumentException('Post Comment cannot be empty.', 0);
        }

        $this->post      = $id;
        $this->comment   = $comment;
        $this->post      = $post;
        $this->user      = $user;
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
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }
}
