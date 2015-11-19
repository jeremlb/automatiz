<?php

namespace Automatiz\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Automatiz\UserBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Automatiz\ApiBundle\Entity\CocktailRepository")
 * @ORM\Table("cocktail")
 * @ORM\HasLifecycleCallbacks()
 */
class Cocktail
{
    /**
     * @var string
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="has_alcoohol", type="boolean", nullable=true)
     */
    private $has_alcoohol;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Step", mappedBy="cocktail", cascade={"persist", "merge", "remove"})
     */

    private $steps;

    /**
     * @ORM\ManyToOne(targetEntity="Automatiz\UserBundle\Entity\User", inversedBy="cocktails")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Automatiz\ApiBundle\Entity\CocktailImage", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Automatiz\ApiBundle\Entity\Stat", mappedBy="cocktail")
     */
    private $stats;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Automatiz\ApiBundle\Entity\Note", mappedBy="cocktail", cascade={"persist", "remove"})
     */
    private $notes;

    public function __construct(User $user)
    {
        $this->steps = new ArrayCollection();
        $this->stats = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->user = $user;
    }

    public function isNew()
    {
        return ($this->getCreatedAt() == $this->getUpdatedAt())? true: false;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $alcoohol
     * @return Cocktail
     */
    public function setHasAlcoohol($alcoohol)
    {
        $this->has_alcoohol = $alcoohol;
        return $this;
    }

    /**
     * @return string
     */
    public function getHasAlcoohol()
    {
        return $this->has_alcoohol;
    }

    /**
     * @param \DateTime $createdAt
     * @return Cocktail
     */
    protected function setCreatedAt($createdAt)
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
     * @param \DateTime $updatedAt
     * @return Cocktail
     */
    protected function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $description
     * @return Cocktail
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
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
     * @return $this
     */
    public function removeStep(Step $step)
    {
        $this->steps->removeElement($step);
        return $this;
    }

    /**
     * @return ArrayCollection<Step>
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param Stat $stat
     * @return $this
     */
    public function addStat(Stat $stat)
    {
        $this->stats->add($stat);
        $stat->setCocktail($this);
        return $this;
    }

    /**
     * @param Stat $stat
     * @return $this
     */
    public function removeStat(Stat $stat)
    {
        $this->stats->removeElement($stat);
        return $this;
    }

    /**
     * @return ArrayCollection<Stat>
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param Note $note
     * @return $this
     */
    public function addNote(Note $note)
    {
        $this->notes->add($note);
        $note->setCocktail($this);
        return $this;
    }

    /**
     * @param Note $note
     * @return $this
     */
    public function removeNote(Note $note)
    {
        $this->notes->removeElement($note);
        return $this;
    }

    /**
     * @return ArrayCollection<Note>
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return CocktailImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param CocktailImage $cocktailImage
     * @return $this
     */
    public function setImage(CocktailImage $cocktailImage)
    {
        $this->image = $cocktailImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        if($this->image) {
            return $this->image->getUrl();
        }
        return null;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }
}