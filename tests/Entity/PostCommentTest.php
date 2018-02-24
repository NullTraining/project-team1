<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Post;
use App\Entity\PostComment;
use App\Entity\User;
use Mockery;
use PHPUnit\Framework\TestCase;

class PostCommentTest extends TestCase
{
    /** @var PostComment $postComment */
    private $postComment;
    /** @var User $user */
    private $user;
    /** @var string $comment */
    private $comment;
    /** @var Post $post */
    private $post;
    /** @var \DateTime */
    private $timestamp;

    public function setUp()
    {
        $this->id        = 12345;
        $this->comment   = 'Post Comment Text';
        $this->post      = Mockery::mock(Post::class);
        $this->user      = Mockery::mock(User::class);
        $this->timestamp = new \DateTime('now');

        /* Set up PostComment */
        $this->postComment = new PostComment();
        $this->postComment->setId($this->id);
        $this->postComment->setPost($this->post);
        $this->postComment->setComment($this->comment);
        $this->postComment->setUser($this->user);
    }

    public function testPostCommentCanBeCreated()
    {
        self::assertInstanceOf(PostComment::class, $this->postComment);
    }

    public function testPostCommentHasContent()
    {
        self::assertEquals($this->postComment->getComment(), $this->comment);
    }

    public function testCommentTextCannotBeEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $postComment = new PostComment();
        $postComment->setId($this->id);
        $postComment->setPost($this->post);
        $postComment->setComment('');
        $postComment->setUser($this->user);
    }

    public function testCommentHasTimestamp()
    {
        self::assertInstanceOf(\DateTime::class, $this->postComment->getTimestamp());
    }
}
