<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 08/10/15
 * Time: 08:59
 */

namespace Automatiz\ApiBundle\Model;



/**
 * Cocktail
 *
 */
abstract class AbstractCocktail
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $has_alcoohol;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @var integer
     */
    private $note;
    /**
     * @var string
     */
    private $description;

    /**
     * Get Id
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
    public function setHasAlcoohol($hasAlcoohol)
    {
        $this->has_alcoohol = $hasAlcoohol;
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
}