<?php

namespace Automatiz\ApiBundle\Entity;

use Automatiz\UserBundle\Entity\User;

class Stat
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Cocktail
     */
    protected $cocktail;
    /**
     * @var \DateTime
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

    public function onPrePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }
}
