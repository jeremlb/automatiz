<?php

namespace Automatiz\ApiBundle\Entity;


class Liquid
{
    protected $id;
    protected $name;
    protected $isAlcohol;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setIsAlcohol($isAlcohol)
    {
        $this->isAlcohol = $isAlcohol;
        return $this;
    }

    public function getIsAlcohol()
    {
        return $this->isAlcohol;
    }
}
