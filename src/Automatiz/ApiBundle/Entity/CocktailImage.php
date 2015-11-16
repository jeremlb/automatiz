<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 11/11/2015
 * Time: 19:47
 */

namespace Automatiz\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("cocktail_image")
 */
class CocktailImage
{
    /**
     * @var string
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     *
     */
    protected $id;

    /**
     * @ORM\Column(name="file", type="string")
     */
    protected $file;

    /**
     * @ORM\Column(name="path", type="string")
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
}