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

    public function setUp()
    {
        $this->id      = 12345;
        $this->comment = 'Post Comment Text';
        $this->post    = Mockery::mock(Post::class);
        $this->user    = Mockery::mock(User::class);

        $this->postComment = new PostComment($this->id, $this->comment, $this->post, $this->user);
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
        new PostComment(6645, '', $this->post, $this->user);
    }

    public function testCommentHasTimestamp()
    {
        self::assertInstanceOf(\DateTime::class, $this->postComment->getTimestamp());
    }
}
