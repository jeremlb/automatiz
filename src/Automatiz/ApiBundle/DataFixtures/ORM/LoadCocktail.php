<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 07/10/15
 * Time: 18:31
 */

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Automatiz\ApiBundle\Entity\Cocktail;
use Automatiz\ApiBundle\Entity\Step;

class LoadCocktail implements  FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $step1 = new Step();
        $step1->setDescription("Ajoutez des glaçons au cocktail");
        $step1->setAddIce(true);

        $step2 = new Step();
        $step2->setDescription("Ajoutez du rhum");
        $step2->setLiquid("RHUM");
        $step2->setQuantity(5);


        $cocktail = new Cocktail();
        $cocktail->setHasAlcoohol(true);
        $cocktail->setDescription("C'est un super cocktail");
        $cocktail->setName("Le Oulanbator");

        $cocktail->addStep($step1);
        $cocktail->addStep($step2);

        $step3 = new Step();
        $step3->setDescription("Ajoutez des glaçons au cocktail");
        $step3->setAddIce(true);

        $step4 = new Step();
        $step4->setDescription("Mumm un bon jus d'orange");
        $step4->setLiquid("ORANGE JUICE");
        $step4->setQuantity(5);


        $cocktail2 = new Cocktail();
        $cocktail2->setHasAlcoohol(false);
        $cocktail2->setDescription("Lourds gros");
        $cocktail2->setName("Le Wapiti");

        $cocktail2->addStep($step3);
        $cocktail2->addStep($step4);



        $manager->persist($cocktail);
        $manager->persist($cocktail2);
        $manager->flush();
    }
}