<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 20/10/2015
 * Time: 15:41
 */

namespace Automatiz\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CocktailRepository extends EntityRepository
{
    public function findAllByName($name)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->where($qb->expr()->like('LOWER(c.name)', '?1'));



        return $qb
            ->setParameter(1, "%".strtolower($name)."%")
            ->getQuery()
            ->getResult()
            ;
    }
}