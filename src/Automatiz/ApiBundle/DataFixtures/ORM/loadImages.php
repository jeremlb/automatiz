<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 20/11/2015
 * Time: 19:53
 */

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Component\HttpFoundation\File\File;

use Automatiz\ApiBundle\Entity\Image;

class loadImages extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $fs = new Filesystem();
        $path = $this->container->getParameter('kernel.root_dir').'/../src/Automatiz/ApiBundle/DataFixtures/Images/';

        $fs->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures');

        $fs->copy($path."daiquirii.jpg", $path."daiquirii-copy.jpg");
        $file = new File($path."daiquirii-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $daiquiri->setImage($image);
        $manager->persist($daiquiri);

        $fs->copy($path."pina-colada.jpg", $path."pina-colada-copy.jpg");
        $file = new File($path."pina-colada-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $pinaColada->setImage($image);
        $manager->persist($pinaColada);

        $fs->copy($path."margarita.jpg", $path."margarita-copy.jpg");
        $file = new File($path."margarita-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $margarita->setImage($image);
        $manager->persist($margarita);

        $fs->copy($path."sex-on-the-beach.jpg", $path."sex-on-the-beach-copy.jpg");
        $file = new File($path."sex-on-the-beach-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $sexOnTheBeach->setImage($image);
        $manager->persist($sexOnTheBeach);

        $fs->copy($path."caipirinha.jpg", $path."caipirinha-copy.jpg");
        $file = new File($path."caipirinha-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $caipirinha->setImage($image);
        $manager->persist($caipirinha);

        $fs->copy($path."cosmopolitan.jpg", $path."cosmopolitan-copy.jpg");
        $file = new File($path."cosmopolitan-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $cosmopolitan->setImage($image);
        $manager->persist($cosmopolitan);

        $fs->copy($path."blue-lagoon.jpg", $path."blue-lagoon-copy.jpg");
        $file = new File($path."blue-lagoon-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $blueLagoon->setImage($image);
        $manager->persist($blueLagoon);

        $fs->copy($path."tequila-sunrise.jpg", $path."tequila-sunrise-copy.jpg");
        $file = new File($path."tequila-sunrise-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $tequilaSunrise->setImage($image);
        $manager->persist($tequilaSunrise);

        $fs->copy($path."bora-bora.jpg", $path."bora-bora-copy.jpg");
        $file = new File($path."bora-bora-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $boraBora->setImage($image);
        $manager->persist($boraBora);

        $fs->copy($path."zombie.jpg", $path."zombie-copy.jpg");
        $file = new File($path."zombie-copy.jpg");
        $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($imageDir, $fileName);
        $image = new Image();
        $image->setFile($fileName);
        $image->setPath($imageDir);
        $image->setUrl("/web/uploads/cocktails_pictures/".$fileName);
        $zombie->setImage($image);
        $manager->persist($zombie);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}