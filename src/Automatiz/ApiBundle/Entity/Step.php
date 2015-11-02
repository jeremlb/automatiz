<?php

namespace Automatiz\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table("step")
 * @ORM\Entity(repositoryClass="Automatiz\ApiBundle\Entity\StepRepository")
 */
class Step
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="smallint", nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="liquid", type="string", length=50, nullable=true)
     *
     */
    private $liquid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="add_ice", type="boolean")
     */
    private $addIce;


    /**
     * @ORM\ManyToOne(targetEntity="Cocktail", inversedBy="steps")
     * @ORM\JoinColumn(name="cocktail_id", referencedColumnName="id")
     */
    private $cocktail;

    public function __construct()
    {
        $this->addIce = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Step
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Step
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return ($this->quantity)? $this->quantity: 0;
    }

    /**
     * Get ice
     *
     * @return boolean
     */
    public function getAddIce()
    {
        return $this->addIce;
    }

    /**
     * Set quantity
     *
     * @param boolean $addIce
     *
     * @return Step
     */
    public function setAddIce($addIce)
    {
        $this->addIce = $addIce;

        return $this;
    }

    /**
     * Get liquid
     *
     * @return string
     */
    public function getLiquid()
    {
        return ($this->liquid)? $this->liquid: "";
    }

    /**
     * Set quantity
     *
     * @param string $liquid
     *
     * @return Step
     */
    public function setLiquid($liquid)
    {
        $this->liquid = $liquid;

        return $this;
    }

    /**
     * Set cocktail
     *
     * @param Cocktail $cocktail
     *
     * @return Step
     */
    public function setCocktail(Cocktail $cocktail)
    {
        $this->cocktail = $cocktail;

        return $this;
    }

    /**
     * Get cocktail
     *
     * @return Cocktail
     */
    public function getCocktail()
    {
        return $this->cocktail;
    }

    public function toString()
    {
        return $this->getDescription();
    }


    public function getAddIceSerialize() {
        if($this->getQuantity() != 0 && $this->getLiquid() != "") {
            return null;
        } else {
            return $this->getAddIce();
        }
    }


    public function getLiquidSerialize() {
        if($this->getAddIce() != false) {
            return null;
        } else {
            return $this->getLiquid();
        }
    }


    public function getQuantitySerialize() {
        if($this->getAddIce() != false) {
            return null;
        } else {
            return $this->getQuantity();
        }
    }

    public function __toString()
    {
        return "".$this->getId();
    }
}

