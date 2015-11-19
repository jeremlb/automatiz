<?php

namespace Automatiz\ApiBundle\Entity;

use Automatiz\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table("stat")
 * @ORM\Entity(repositoryClass="Automatiz\ApiBundle\Entity\StepRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Stat
{
    /**
     * @var string
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Automatiz\UserBundle\Entity\User", inversedBy="stats")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var Cocktail
     * @ORM\ManyToOne(targetEntity="Cocktail", inversedBy="stats")
     * @ORM\JoinColumn(name="cocktail_id", referencedColumnName="id")
     */
    protected $cocktail;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Cocktail $cocktail
     * @return $this
     */
    public function setCocktail(Cocktail $cocktail)
    {
        $this->cocktail = $cocktail;
        return $this;
    }

    /**
     * @return Cocktail
     */
    public function getCocktail()
    {
        return $this->cocktail;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param User $user
     * @param Cocktail $cocktail
     */
    public function __construct(User $user, Cocktail $cocktail)
    {
        $this->setCocktail($cocktail);
        $this->setUser($user);
    }

    /**
    * Set the Datetime of the insertion into the Database
    * @ORM\PrePersist()
    */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }
}