<?php

namespace Automatiz\ApiBundle\Entity;

use Automatiz\UserBundle\Entity\User;

class Note
{
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
     * @var int
     */
    protected $note;

    /**
     * @var \Datetime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @param User $user
     * @param Cocktail $cocktail
     * @param $note
     */
    public function __construct(User $user, Cocktail $cocktail, $note)
    {
        $this->setUser($user);
        $this->setCocktail($cocktail);
        $this->setNote($note);
    }

    public function onPrePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
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
     * @return Cocktail
     */
    public function getCocktail()
    {
        return $this->cocktail;
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
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Datetime $createdAt
     * @return $this
     */
    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}
