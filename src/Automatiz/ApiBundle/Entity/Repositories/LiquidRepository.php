<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 26/12/2015
 * Time: 09:18
 */

namespace Automatiz\ApiBundle\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class LiquidRepository extends EntityRepository
{
    public function findCocktailsByLiquid($liquid)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->where($qb->expr()->like('LOWER(c.name)', '?1'));

//        return $qb
//            ->setParameter(1, "%".strtolower($liquid)."%")
//            ->getQuery()
//            ->getResult()
//            ;
        return null;
    }
}