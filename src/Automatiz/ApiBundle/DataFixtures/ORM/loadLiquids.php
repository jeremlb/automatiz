<?php

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Automatiz\ApiBundle\Entity\Liquid;

class loadLiquids extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Alcohol
        $rhumBlanc = new Liquid("Rhum Blanc", true);
        $rhumAmbre = new Liquid("Rhum Ambré", true);
        $vodka = new Liquid("Vodka", true);
        $gin = new Liquid("Gin", true);
        $martini = new Liquid("Martini", true);
        $tequila = new Liquid("Tequila", true);
        $curacao = new Liquid("Curaçao bleu", true);
        $tripleSec = new Liquid("Triple sec (Cointreau, Grand Marnier)", true);
        $cachaca = new Liquid("Cachaça", true);
        $liqueurAbricot = new Liquid("Liqueur d'abricot", true);
        $chambort = new Liquid("Chambort", true);

        // Syrup
        $siropCanne = new Liquid("Sirop de canne");
        $siropGrenadine = new Liquid("Sirop de grenadine");
        $siropMelon = new Liquid("Sirop de melon");

        // Juice
        $jusCitronVert = new Liquid("Jus de citron vert");
        $jusCitron = new Liquid("Jus de citron");
        $jusTomate = new Liquid("Jus de tomate");
        $jusAnanas = new Liquid("Jus d'ananas");
        $jusOrange = new Liquid("Jus d'orange");
        $jusMultiFruit = new Liquid("Jus Multifruit");
        $jusCranberry = new Liquid("Jus de cranberry");

        // Milk
        $laitCoco = new Liquid("Lait de coco");

        $manager->persist($rhumBlanc);
        $manager->persist($rhumAmbre);
        $manager->persist($vodka);
        $manager->persist($gin);
        $manager->persist($martini);
        $manager->persist($tequila);
        $manager->persist($curacao);
        $manager->persist($tripleSec);
        $manager->persist($cachaca);
        $manager->persist($liqueurAbricot);
        $manager->persist($chambort);
        $manager->persist($siropCanne);
        $manager->persist($siropGrenadine);
        $manager->persist($siropMelon);
        $manager->persist($jusCitronVert);
        $manager->persist($jusCitron);
        $manager->persist($jusTomate);
        $manager->persist($jusAnanas);
        $manager->persist($jusOrange);
        $manager->persist($jusMultiFruit);
        $manager->persist($jusCranberry);
        $manager->persist($laitCoco);

        $manager->flush();

        $this->addReference("liquid-rhum-blanc", $rhumBlanc);
        $this->addReference("liquid-rhum-ambre", $rhumAmbre);
        $this->addReference("liquid-vodka", $vodka);
        $this->addReference("liquid-tequila", $tequila);
        $this->addReference("liquid-gin", $gin);
        $this->addReference("liquid-martini", $martini);
        $this->addReference("liquid-caracao", $curacao);
        $this->addReference("liquid-triple-sec", $tripleSec);
        $this->addReference("liquid-cachaca", $cachaca);
        $this->addReference("liquid-liqueur-abricot", $liqueurAbricot);
        $this->addReference("liquid-chambort", $chambort);
        $this->addReference("liquid-sirop-canne", $siropCanne);
        $this->addReference("liquid-sirop-grenadine", $siropGrenadine);
        $this->addReference("liquid-sirop-melon", $siropMelon);
        $this->addReference("liquid-jus-citron-vert", $jusCitronVert);
        $this->addReference("liquid-jus-citron", $jusCitron);
        $this->addReference("liquid-jus-tomate", $jusTomate);
        $this->addReference("liquid-jus-ananas", $jusAnanas);
        $this->addReference("liquid-jus-orange", $jusOrange);
        $this->addReference("liquid-jus-multifruit", $jusMultiFruit);
        $this->addReference("liquid-jus-cranberry", $jusCranberry);
        $this->addReference("liquid-lait-coco", $laitCoco);
    }

    public function getOrder()
    {
        return 2;
    }
}