<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 20/10/2015
 * Time: 21:29
 */

namespace Automatiz\ApiBundle\Doctrine;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

/**
 * Class RandomIdGenerator
 * @package Automatiz\ApiBundle\Doctrine
 *
 * @description Generate an unique id for Entities
 */
class RandomIdGenerator extends AbstractIdGenerator
{
    /**
     * @param EntityManager $em
     * @param \Doctrine\ORM\Mapping\Entity $entity
     * @return string
     */
    public function generate(EntityManager $em, $entity)
    {
        return uniqid();
    }
}