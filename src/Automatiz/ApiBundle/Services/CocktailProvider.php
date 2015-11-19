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

use Automatiz\ApiBundle\Entity\Cocktail;
use Automatiz\UserBundle\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CocktailProvider
{
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function addCocktail(User $user) {
        $cocktail = new Cocktail($user);
        return $cocktail;
    }

    public function getCocktail($id)
    {
        $cocktail = $this->entityManager->getRepository('AutomatizApiBundle:Cocktail')->find($id);

        if (!$cocktail instanceof Cocktail) {
            throw new NotFoundHttpException('Cocktail not found');
        }

        return $cocktail;
    }
}