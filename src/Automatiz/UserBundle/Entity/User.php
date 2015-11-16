<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 02/11/2015
 * Time: 12:18
 */

namespace Automatiz\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Automatiz\ApiBundle\Entity\Cocktail;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 */
class User extends BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Automatiz\ApiBundle\Doctrine\RandomIdGenerator")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Automatiz\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */

    protected $groups;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Automatiz\ApiBundle\Entity\Cocktail", mappedBy="user", cascade={"remove"})
     *
     */
    protected $cocktails;

    public function __construct()
    {
        parent::__construct();
        $this->cocktails = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getCocktails()
    {
        return $this->cocktails;
    }
}