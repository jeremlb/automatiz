<?php

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Automatiz\ApiBundle\Entity\Step;


class loadSteps extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Liquids
        $rhumBlanc = $this->getReference("liquid-rhum-blanc");
        $rhumAmbre = $this->getReference("liquid-rhum-ambre");
        $tequila = $this->getReference("liquid-tequila");
        $vodka = $this->getReference("liquid-vodka");
        $gin = $this->getReference("liquid-gin");
        $martini = $this->getReference("liquid-martini");
        $curacao = $this->getReference("liquid-caracao");
        $tripleSec = $this->getReference("liquid-triple-sec");
        $cachaca = $this->getReference("liquid-cachaca");
        $liqueurAbricot = $this->getReference("liquid-liqueur-abricot");
        $chambort = $this->getReference("liquid-chambort");
        $siropCanne = $this->getReference("liquid-sirop-canne");
        $siropGrenadine = $this->getReference("liquid-sirop-grenadine");
        $siropMelon = $this->getReference("liquid-sirop-melon");
        $jusCitronVert = $this->getReference("liquid-jus-citron-vert");
        $jusCitron = $this->getReference("liquid-jus-citron");
        $jusTomate = $this->getReference("liquid-jus-tomate");
        $jusAnanas = $this->getReference("liquid-jus-ananas");
        $jusOrange = $this->getReference("liquid-jus-orange");
        $jusMultiFruit = $this->getReference("liquid-jus-multifruit");
        $jusCranberry = $this->getReference("liquid-jus-cranberry");
        $laitCoco = $this->getReference("liquid-lait-coco");

        // Cocktails
        $daiquiri = $this->getReference("daiquiri");
        $pinaColada = $this->getReference("pinaColada");
        $margarita = $this->getReference("margarita");
        $sexOnTheBeach = $this->getReference("sexOnTheBeach");
        $caipirinha = $this->getReference("caipirinha");
        $cosmopolitan = $this->getReference("cosmopolitan");
        $blueLagoon = $this->getReference("blueLagoon");
        $tequilaSunrise = $this->getReference("tequilaSunrise");
        $boraBora = $this->getReference("boraBora");
        $zombie = $this->getReference("zombie");

        // Daiquiri
        $step = new Step();
        $step->setDescription("Ajoutez des glaçons");
        $step->setAddIce(true);
        $daiquiri->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du rhum ambré");
        $step->setLiquid($rhumAmbre);
        $step->setQuantity(4);
        $daiquiri->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du citron vert");
        $step->setLiquid($jusCitronVert);
        $step->setQuantity(2);
        $daiquiri->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de sucre de canne");
        $step->setLiquid($siropCanne);
        $step->setQuantity(1);
        $daiquiri->addStep($step);

        $manager->persist($daiquiri);

        // Pina Colada
        $step = new Step();
        $step->setDescription("Ajoutez des glaçons");
        $step->setAddIce(true);
        $pinaColada->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du rhum blanc");
        $step->setLiquid($rhumBlanc);
        $step->setQuantity(4);
        $pinaColada->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du rhum ambré");
        $step->setLiquid($rhumAmbre);
        $step->setQuantity(2);
        $pinaColada->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez le jus d'ananas");
        $step->setLiquid($jusAnanas);
        $step->setQuantity(12);
        $pinaColada->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez le lait de coco");
        $step->setLiquid($laitCoco);
        $step->setQuantity(2);
        $pinaColada->addStep($step);

        $manager->persist($pinaColada);

        // Margarita
        $step = new Step();
        $step->setDescription("Ajoutez de la tequila");
        $step->setLiquid($tequila);
        $step->setQuantity(5);
        $margarita->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du triple sec");
        $step->setLiquid($tripleSec);
        $step->setQuantity(3);
        $margarita->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du rhum blanc");
        $step->setLiquid($jusCitronVert);
        $step->setQuantity(2);
        $margarita->addStep($step);

        $manager->persist($margarita);

        // Sex on the beach
        $step = new Step();
        $step->setDescription("Ajoutez de la vodka");
        $step->setLiquid($vodka);
        $step->setQuantity(3);
        $sexOnTheBeach->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de melon");
        $step->setLiquid($siropMelon);
        $step->setQuantity(2);
        $sexOnTheBeach->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du chambort");
        $step->setLiquid($chambort);
        $step->setQuantity(2);
        $sexOnTheBeach->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus d'ananas");
        $step->setLiquid($jusAnanas);
        $step->setQuantity(5);
        $sexOnTheBeach->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de cranberry (canneberges)");
        $step->setLiquid($jusCranberry);
        $step->setQuantity(6);
        $sexOnTheBeach->addStep($step);

        $manager->persist($sexOnTheBeach);

        // Caipirinha
        $step = new Step();
        $step->setDescription("Ajoutez du jus du cachaça");
        $step->setLiquid($cachaca);
        $step->setQuantity(6);
        $caipirinha->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de citron vert");
        $step->setLiquid($jusCitronVert);
        $step->setQuantity(1);
        $caipirinha->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sucre de canne");
        $step->setLiquid($siropCanne);
        $step->setQuantity(1);
        $caipirinha->addStep($step);

        $manager->persist($caipirinha);

        // Cosmopolitan
        $step = new Step();
        $step->setDescription("Ajoutez du jus de la vodka");
        $step->setLiquid($vodka);
        $step->setQuantity(4);
        $cosmopolitan->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du triple sec");
        $step->setLiquid($tripleSec);
        $step->setQuantity(2);
        $cosmopolitan->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de cranberry (canneberges)");
        $step->setLiquid($jusCranberry);
        $step->setQuantity(2);
        $cosmopolitan->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de citron vert");
        $step->setLiquid($jusCitronVert);
        $step->setQuantity(1);
        $cosmopolitan->addStep($step);

        $manager->persist($cosmopolitan);

        // Blue Lagoon
        $step = new Step();
        $step->setDescription("Ajoutez du jus de la vodka");
        $step->setLiquid($vodka);
        $step->setQuantity(4);
        $blueLagoon->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus du caraçao bleu");
        $step->setLiquid($curacao);
        $step->setQuantity(3);
        $blueLagoon->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de citron");
        $step->setLiquid($jusCitron);
        $step->setQuantity(2);
        $blueLagoon->addStep($step);

        $manager->persist($blueLagoon);

        // Tequila Sunrise
        $step = new Step();
        $step->setDescription("Ajoutez du jus de la tequila");
        $step->setLiquid($tequila);
        $step->setQuantity(6);
        $tequilaSunrise->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus d'orange");
        $step->setLiquid($jusOrange);
        $step->setQuantity(12);
        $tequilaSunrise->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de grenadine");
        $step->setLiquid($siropGrenadine);
        $step->setQuantity(2);
        $tequilaSunrise->addStep($step);

        $manager->persist($tequilaSunrise);

        // Bora bora
        $step = new Step();
        $step->setDescription("Ajoutez du jus d'ananas");
        $step->setLiquid($jusAnanas);
        $step->setQuantity(10);
        $boraBora->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus multifruit");
        $step->setLiquid($jusMultiFruit);
        $step->setQuantity(6);
        $boraBora->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de grenadine");
        $step->setLiquid($siropGrenadine);
        $step->setQuantity(2);
        $boraBora->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de citron");
        $step->setLiquid($jusCitron);
        $step->setQuantity(1);
        $boraBora->addStep($step);

        $manager->persist($boraBora);

        // Zombie
        $step = new Step();
        $step->setDescription("Ajoutez du rhum blanc");
        $step->setLiquid($rhumBlanc);
        $step->setQuantity(3);
        $zombie->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du rhum ambré");
        $step->setLiquid($rhumAmbre);
        $step->setQuantity(3);
        $zombie->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez de la liqueur d'abricot");
        $step->setLiquid($liqueurAbricot);
        $step->setQuantity(1.5);
        $zombie->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus de citron vert");
        $step->setLiquid($jusCitronVert);
        $step->setQuantity(2);
        $zombie->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de grenadine");
        $step->setLiquid($siropGrenadine);
        $step->setQuantity(0.5);
        $tequilaSunrise->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du jus d'ananas");
        $step->setLiquid($jusAnanas);
        $step->setQuantity(6);
        $zombie->addStep($step);

        $step = new Step();
        $step->setDescription("Ajoutez du sirop de sucre de canne");
        $step->setLiquid($siropCanne);
        $step->setQuantity(1.5);
        $zombie->addStep($step);

        $manager->persist($zombie);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}