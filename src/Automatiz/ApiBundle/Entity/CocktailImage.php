<?php

namespace Automatiz\ApiBundle\Entity;

class CocktailImage
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $file;
    /**
     * @var string
     */
    protected $path;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

    public function getPath()
    {
      return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}
