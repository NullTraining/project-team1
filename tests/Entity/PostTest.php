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
    /** @var bool */
    private $active;
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
        $this->content      = 'test post content';
        $this->archived     = false;
        $this->active       = true;
        $this->createdAt    = new \DateTime('now');
        $this->author       = Mockery::mock(User::class);
        $this->category     = Mockery::mock(Category::class);
        $this->post         = new Post();

        /* Set up the Post */
        $this->post->setId($this->id);
        $this->post->setTitle($this->title);
        $this->post->setContent($this->content);
        $this->post->setAuthor($this->author);
        $this->post->setCategory($this->category);
        $this->post->setCreatedAt($this->createdAt);
    }

    public function testPostCanBeCreated()
    {
        self::assertInstanceOf(Post::class, $this->post);
    }

    public function testGetPostId()
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

    public function testGetPostActive()
    {
        self::assertEquals($this->active, $this->post->isActive());
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

    public function testPostCanBeDeactivated()
    {
        $this->post->deactivate();

        self::assertFalse($this->post->isActive());
    }

    public function testArchivedPostIsNotActive()
    {
        $this->post->archive();

        self::assertFalse($this->post->isActive());
    }

    public function testActivateActionWillUnarchivePost()
    {
        $this->post->archive();
        $this->post->activate();

        self::assertFalse($this->post->isArchived());
    }
}
