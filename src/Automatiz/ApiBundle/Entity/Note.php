<?php

namespace Automatiz\ApiBundle\Entity;

use Automatiz\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("cocktail_note")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Note
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
     * @ORM\OneToOne(targetEntity="Automatiz\UserBundle\Entity\User", cascade={"persist"})
     */
    protected $user;

    /**
     * @var Cocktail
     * @ORM\ManyToOne(targetEntity="Cocktail", inversedBy="notes")
     * @ORM\JoinColumn(name="cocktail_id", referencedColumnName="id")
     */
    protected $cocktail;

    /**
     * @var int
     * @ORM\Column(name="note", type="smallint")
     */
    protected $note;

    /**
     * @var \Datetime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var string
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;

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

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }
}