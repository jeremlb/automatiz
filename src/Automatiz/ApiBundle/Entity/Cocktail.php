<?php

namespace Automatiz\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Automatiz\UserBundle\Entity\User;

class Cocktail
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $hasAlcohol;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @var string
     */
    private $description;
    /**
     * @var array
     */
    private $categories;
    /**
     * @var ArrayCollection<Step>
     */
    private $steps;
    /**
     * @var User
     */
    private $user;
    /**
     * @var CocktailImage
     */
    private $image;
    /**
     * @var ArrayCollection<Stat>
     */
    private $stats;
    /**
     * @var ArrayCollection<Note>
     */
    private $notes;

    /**
     * @param User $user
     * @param array $categories
     */
    public function __construct(User $user, $categories = array())
    {
        $this->steps = new ArrayCollection();
        $this->stats = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->categories = $categories;
        $this->user = $user;
    }

    public function onPreUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    public function onPrePersist()
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

    /**
     * @return bool
     */
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
     * @param string $alcohol
     * @return Cocktail
     */
    public function setHasAlcohol($hasAlcohol)
    {
        $this->hasAlcohol = $hasAlcohol;
        return $this;
    }

    /**
     * @return string
     */
    public function getHasAlcohol()
    {
        return $this->hasAlcohol;
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
     * @param User $user
     * @return Cocktail
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
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
     * @param string $category
     * @return Cocktail
     */
    public function addCategory($category)
    {
        if (!$this->hasCategory($category)) {
            $this->categories[] = strtoupper($category);
        }

        return $this;
    }

    /**
     * @param string $category
     * @return boolean
     */
    public function hasCategory($category)
    {
        return in_array(strtoupper($category), $this->categories, true);
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $category
     * @return Cocktail
     */
    public function removeCategory($category)
    {
        if (false !== $key = array_search(strtoupper($category), $this->categories, true)) {
            unset($this->categories[$key]);
            $this->categories = array_values($this->categories);
        }

        return $this;
    }

    /**
     * @param array $categories
     * @return Cocktail
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * Used by JMS Serializer
     * @return string/null
     */
    public function getImageUrl()
    {
        if($this->image) {
            return $this->image->getUrl();
        }

        return null;
    }
}
