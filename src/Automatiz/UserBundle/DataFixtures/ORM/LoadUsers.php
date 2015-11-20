<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 07/10/15
 * Time: 18:31
 */

namespace Automatiz\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Automatiz\UserBundle\Entity\User;

class loadUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEmail("jeremi.leb@gmail.com");
        $user->setFirstName("Jérémi");
        $user->setLastname("Le Bourhis");
        $user->setUsername("wapiti");
        $user->setPlainPassword("wapiti");
        $user->setEnabled(true);

        $user3 = $userManager->createUser();
        $user3->setEmail("jlebourhis@gmail.com");
        $user3->setFirstName("Jérémi");
        $user3->setLastname("Le Bourhis");
        $user3->setUsername("jeremlb");
        $user3->setPlainPassword("jeremlb");
        $user3->setEnabled(true);

        $user2 = $userManager->createUser();
        $user2->setEmail("jeremlb@aol.com");
        $user2->setFirstName("Admin");
        $user2->setLastname("Admin");
        $user2->setUsername("admin");
        $user2->setPlainPassword("admin");
        $user2->addRole("ROLE_ADMIN");
        $user2->setEnabled(true);

        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->flush();

        $this->addReference('normal-user', $user);
        $this->addReference('normal-user2', $user3);
        $this->addReference('admin-user', $user2);
    }

    public function getOrder()
    {
        return 1;
    }
}