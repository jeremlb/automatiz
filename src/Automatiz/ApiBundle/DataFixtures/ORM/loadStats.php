<?php

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Automatiz\ApiBundle\Entity\Stat;

class loadStats extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference("normal-user");
        $user2 = $this->getReference("normal-user2");
        $admin = $this->getReference("admin-user");

        $cosmopolitan = $this->getReference("daiquiri");
        $boraBora = $this->getReference("boraBora");

        $stat = new Stat($user, $cosmopolitan);
        $manager->persist($stat);

        $stat = new Stat($user2, $cosmopolitan);
        $manager->persist($stat);

        $stat = new Stat($user, $cosmopolitan);
        $manager->persist($stat);

        $stat = new Stat($user, $boraBora);
        $manager->persist($stat);

        $stat = new Stat($user2, $boraBora);
        $manager->persist($stat);

        $stat = new Stat($admin, $boraBora);
        $manager->persist($stat);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
