<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\PostComment;
use App\Entity\User;
use Mockery;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /** @var int */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $content;
    /** @var Post */
    private $post;
    /** @var bool */
    private $archived;
    /** @var \DateTime */
    private $createdAt;
    /** @var string */
    private $author;
    /** @var string */
    private $category;

    public function setUp()
    {
        $this->id           = 12345;
        $this->title        = 'test post title';
        $this->content      = 'test post title';
        $this->archived     = false;
        $this->createdAt    = new \DateTime('now');
        $this->author       = Mockery::mock(User::class);
        $this->category     = Mockery::mock(Category::class);
        $this->post         = new Post($this->id, $this->title, $this->content, $this->createdAt, $this->author, $this->category);
    }

    public function testPostCanBeCreated()
    {
        self::assertInstanceOf(Post::class, $this->post);
    }

    public function testGetPostID()
    {
        self::assertEquals($this->id, $this->post->getId());
    }

    public function testGetPostTitle()
    {
        self::assertEquals($this->title, $this->post->getTitle());
    }

    public function testGetPostContent()
    {
        self::assertEquals($this->content, $this->post->getContent());
    }

    public function testGetPostCreationDate()
    {
        self::assertEquals($this->createdAt, $this->post->getCreatedAt());
    }

    public function testGetPostAuthor()
    {
        self::assertEquals($this->author, $this->post->getAuthor());
    }

    public function testGetPostCategory()
    {
        self::assertEquals($this->category, $this->post->getCategory());
    }

    public function testGetPostArchived()
    {
        self::assertEquals($this->archived, $this->post->isArchived());
    }

    public function testGetPostCommentsCount()
    {
        $postComment  = Mockery::mock(PostComment::class);

        $this->post->addComment($postComment);

        self::assertEquals(1, $this->post->getComments()->count());
    }

    public function testPostCommentIsAdded()
    {
        $postComment  = Mockery::mock(PostComment::class);

        $this->post->addComment($postComment);

        self::assertEquals(1, $this->post->getComments()->contains($postComment));
    }

    public function testPostCanBeArchived()
    {
        $this->post->archive();

        self::assertTrue($this->post->isArchived());
    }
}
