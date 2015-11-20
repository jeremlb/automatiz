<?php

namespace Automatiz\ApiBundle\Entity;

class Step
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $description;
    /**
     * @var integer
     */
    private $quantity;
    /**
     * @var string
     */
    private $liquid;
    /**
     * @var boolean
     */
    private $addIce;
    /**
     * @var Cocktail
     */
    private $cocktail;

    public function __construct()
    {
        $this->addIce = false;
        $this->liquid = null;
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
     * @return Liquid
     */
    public function getLiquid()
    {
        return $this->liquid;
    }

    /**
     * Set quantity
     *
     * @param Liquid $liquid
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
            return $this->getLiquid()->getName();
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
