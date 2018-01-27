<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var bool
     */
    private $administrator;

    public function __construct()
    {
        parent::__construct();

        $this->administrator = false;
        $this->comments      = new ArrayCollection();
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
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
