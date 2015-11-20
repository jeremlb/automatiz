<?php

namespace Automatiz\ApiBundle\Entity;

class Liquid
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var boolean
     */
    protected $isAlcohol;

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
     * @param $name
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
     * @param $isAlcohol
     * @return $this
     */
    public function setIsAlcohol($isAlcohol)
    {
        $this->isAlcohol = $isAlcohol;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsAlcohol()
    {
        return $this->isAlcohol;
    }
}
