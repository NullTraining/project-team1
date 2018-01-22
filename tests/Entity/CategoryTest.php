<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Mockery;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /** @var int $categoryId */
    private $categoryId;
    /** @var string $categoryName */
    private $categoryName;
    /** @var ArrayCollection $categoryPosts */
    private $categoryPosts;
    /** @var Category $category */
    private $category;
    /** @var Post $post */
    private $post;

    public function setUp()
    {
        $this->categoryId    = 12345;
        $this->categoryName  = 'Test Category Name';
        $this->categoryPosts = Mockery::mock(ArrayCollection::class);
        $this->post          = Mockery::mock(Post::class);
        $this->category      = new Category($this->categoryId, $this->categoryName);
    }

    public function testCategoryCanBeCreated()
    {
        self::assertInstanceOf(Category::class, $this->category);
    }

    public function testGetId()
    {
        self::assertEquals($this->categoryId, $this->category->getId());
    }

    public function testGetName()
    {
        self::assertEquals($this->categoryName, $this->category->getName());
    }

    public function testAddPost()
    {
        $this->category->addPost($this->post);
        self::assertEquals(1, $this->category->getPosts()->count());
    }
}
