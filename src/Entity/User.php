<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\PostComment", mappedBy="user")
     */
    private $comments;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="author")
     */
    private $posts;

    /**
     * @var bool
     */
    private $administrator;

    public function __construct()
    {
        parent::__construct();

        $this->administrator = false;
        $this->comments      = new ArrayCollection();
        $this->posts         = new ArrayCollection();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * Promote the user to Administrator.
     *
     * This will make the user part of the Administration Staff
     */
    public function promoteToAdministrator()
    {
        $this->administrator = true;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->administrator;
    }
}
