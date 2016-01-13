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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $description
     * @return Step
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
     * @param integer $quantity
     * @return Step
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return ($this->quantity)? $this->quantity: 0;
    }

    /**
     * @return boolean
     */
    public function getAddIce()
    {
        return $this->addIce;
    }

    /**
     * @param boolean $addIce
     * @return Step
     */
    public function setAddIce($addIce)
    {
        $this->addIce = $addIce;

        if($addIce == true) {
            $this->setDescription("");
        }
        return $this;
    }

    /**
     * @return Liquid
     */
    public function getLiquid()
    {
        return $this->liquid;
    }

    /**
     * @param Liquid $liquid
     * @return Step
     */
    public function setLiquid($liquid)
    {
        $this->liquid = $liquid;
        return $this;
    }

    /**
     * @param Cocktail $cocktail
     * @return Step
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
     * @return bool|null
     */
    public function getAddIceSerialize() {
        if($this->getQuantity() != 0 && $this->getLiquid() != "") {
            return null;
        } else {
            return $this->getAddIce();
        }
    }

    /**
     * @return null|string
     */
    public function getLiquidSerialize() {
        if($this->getAddIce() != false) {
            return null;
        } else {
            return $this->getLiquid()->getName();
        }
    }

    /**
     * @return int|null
     */
    public function getQuantitySerialize() {
        if($this->getAddIce() != false) {
            return null;
        } else {
            return $this->getQuantity();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "".$this->getId();
    }
}
