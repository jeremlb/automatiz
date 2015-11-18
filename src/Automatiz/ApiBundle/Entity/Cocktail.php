<?php

namespace Automatiz\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Automatiz\UserBundle\Entity\User;

/**
 * Cocktail
 * @ORM\Entity(repositoryClass="Automatiz\ApiBundle\Entity\CocktailRepository")
 * @ORM\Table("cocktail")
 * @ORM\HasLifecycleCallbacks()
 *
 *
 */
class Cocktail
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     *
     */

    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="has_alcoohol", type="boolean", nullable=true)
     */
    private $has_alcoohol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="smallint")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Step", mappedBy="cocktail", cascade={"persist", "merge", "remove"})
     */

    private $steps;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Automatiz\UserBundle\Entity\User", inversedBy="cocktails")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Automatiz\ApiBundle\Entity\CocktailImage", cascade={"persist", "remove"})
     */
    private $image;

    public function __construct(User $user)
    {
        $this->steps = new ArrayCollection();
        $this->user = $user;
    }

    public function isNew()
    {
        return ($this->getCreatedAt() == $this->getUpdatedAt())? true: false;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Cocktail
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set alcoohol
     *
     * @param string $alcoohol
     *
     * @return Cocktail
     */
    public function setHasAlcoohol($alcoohol)
    {
        $this->has_alcoohol = $alcoohol;

        return $this;
    }

    /**
     * Get alcoohol
     *
     * @return string
     */
    public function getHasAlcoohol()
    {
        return $this->has_alcoohol;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Cocktail
     */
    protected function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Cocktail
     */
    protected function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Cocktail
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Cocktail
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Step $step
     * @return $this
     */
    public function addStep(Step $step)
    {
        $this->steps->add($step);

        $step->setCocktail($this);

        return $this;
    }

    /**
     * @param Step $step
     */
    public function removeStep(Step $step)
    {
        $this->steps->removeElement($step);
    }

    /**
     * @return ArrayCollection
     */
    public function getSteps()
    {
        return $this->steps;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($cocktailImage)
    {
        $this->image = $cocktailImage;
        return $this;
    }

    public function getImageUrl()
    {
        if($this->image) {
            return $this->image->getUrl();
        }

        return null;

    }

    /**
     * Set the Datetime of the insertion into the Database
     * @ORM\PreUpdate()
     *
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**

     * Set the Datetime of the insertion into the Database
     * @ORM\PrePersist()
     *
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->setNote(0);
    }

    public function __toString() {
        return $this->getName()." ".$this->getDescription();
    }
}