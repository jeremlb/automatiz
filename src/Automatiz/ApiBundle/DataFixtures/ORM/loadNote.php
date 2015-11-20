<?php

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Automatiz\ApiBundle\Entity\Note;

class loadNotes extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference("normal-user");
        $user2 = $this->getReference("normal-user2");
        $admin = $this->getReference("admin-user");

        $daiquiri = $this->getReference("daiquiri");
        $pinaColada = $this->getReference("pinaColada");

        $note = new Note($user, $daiquiri, 4);
        $note->setComment("C'est un super cocktail");
        $manager->persist($note);

        $note = new Note($user2, $daiquiri, 3);
        $note->setComment("Avec un peu plus d'alcool, c'est toujours meilleur ! #alcoolique :)");
        $manager->persist($note);

        $note = new Note($admin, $daiquiri, 1);
        $note->setComment("Qui a pu inventé ça ? Dégeu");
        $manager->persist($note);

        $note = new Note($user, $pinaColada, 5);
        $manager->persist($note);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
