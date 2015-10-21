<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 06/10/15
 * Time: 14:59
 */

namespace Automatiz\ApiBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Router;

use Automatiz\ApiBundle\Model\AbstractCocktail;
use Automatiz\ApiBundle\Entity\Step;

class CocktailProvider
{
    private $entityManager;
    private $router;

    public function __construct(EntityManager $entityManager, Router $router) {
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function addCocktail() {
        $cocktail = new Cocktail();

        return $cocktail;
    }
}