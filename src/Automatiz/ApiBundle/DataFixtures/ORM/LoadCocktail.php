<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 07/10/15
 * Time: 18:31
 */

namespace Automatiz\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Automatiz\ApiBundle\Entity\Cocktail;
use Automatiz\ApiBundle\Entity\Image;



class loadCocktails extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference("normal-user");
        $user2 = $this->getReference("normal-user2");
        $admin = $this->getReference("admin-user");

        $daiquiri = new Cocktail($user);
        $daiquiri->setName("Daiquiri");
        $daiquiri->setDescription("Appelé aussi à tort \"Daikiri\", cette recette fût inventée en 1896 par l'ingénieur \"Pagliuchi\" quand il visita une mine de fer nommée \"Daïquirí\" à l'est de Cuba, où travaillait \"Jennings S. Cox\", un ingénieur américain. La journée de travail terminée, Pagliuchi proposa de boire un verre.");

        $image = new Image();
        $image->setFile("")->setPath("")->setUrl("");
        $daiquiri->setImage($image);

        $pinaColada = new Cocktail($admin);
        $pinaColada->setName("Piña Colada");
        $pinaColada->setDescription("Une boisson que les amateurs de cocktails authentiques dégusteront avec plaisir. Le lait de coco, le jus d'ananas et le rhum constituent un mélange vraiment très savoureux.");

        $margarita = new Cocktail($user);
        $margarita->setName("Margarita");
        $margarita->setDescription("Une part acide, une part sucrée, une part amère: la formule magique qui a fait surgir beaucoup de dérivés, mais... l'original est toujours là, fidèle au poste et sans une ride, une référence.");

        $sexOnTheBeach = new Cocktail($user2);
        $sexOnTheBeach->setName("Sex on the beach");
        $sexOnTheBeach->setDescription("Le Sex on the beach est un cocktail alcoolisé créé par le TGI Friday's");

        $caipirinha = new Cocktail($admin);
        $caipirinha->setName("Caipirinha");
        $caipirinha->setDescription("La Caipirinha (prononcer \"caïpirigna\") est un délicieux cocktail à la mode Brésilienne à base de cachaça. Vous aimez le Brésil, la Samba, une compagnie agréable... vous aimerez la Caipirinha !!!");

        $cosmopolitan = new Cocktail($user);
        $cosmopolitan->setName("Cosmopolitan");
        $cosmopolitan->setDescription("Un grand classique des soirées mondaines souvent appelé par son nom abrégé : \"Cosmo\" et à tort \"Cosmopolitain\", comme il n'est pas rare de le trouver en France. Bien que cette recette soit servie dans un verre à martini, ce n'est pas un martini.");

        $blueLagoon = new Cocktail($admin);
        $blueLagoon->setName("Blue Lagoon");
        $blueLagoon->setDescription("Appelé aussi le \"lagon bleu\" par sa traduction. Il fut créé par Andy MacElhone au Harry’s Bar à Paris en 1960.");

        $tequilaSunrise = new Cocktail($user);
        $tequilaSunrise->setName("Tequila Sunrise");
        $tequilaSunrise->setDescription("La couleur du lever de soleil lui a valu son nom! La réputation du Tequila Sunrise n'est plus à faire. Mais saviez-vous que la recette mondialement connue n'est pas la recette originale ?");

        $boraBora = new Cocktail($user2);
        $boraBora->setName("Bora bora");
        $boraBora->setDescription("Dans les années 1980, le patron d'un bar de New York prévient son barman alcoolique qu'il le vire dans la semaine s'il continue à être plus ivre que les clients.");

        $zombie = new Cocktail($user);
        $zombie->setName("Zombie");
        $zombie->setDescription("Comme un Zombie contient des ingrédients assez forts, il est préférable de ne le déguster que de temps en temps. Il existe une centaine de recettes différentes du Zombie. Certaines contiennent du Cognac, d'autres de l'apricot Brandy. Mais toutes contiennent du rhum, le vrai secret de ce cocktail. On ne peut pas dire quelle variante est apparue en premier et qui les a crées. ");

        $manager->persist($daiquiri);
        $manager->persist($pinaColada);
        $manager->persist($margarita);
        $manager->persist($sexOnTheBeach);
        $manager->persist($caipirinha);
        $manager->persist($cosmopolitan);
        $manager->persist($blueLagoon);
        $manager->persist($tequilaSunrise);
        $manager->persist($boraBora);
        $manager->persist($zombie);

        $this->addReference("daiquiri", $daiquiri);
        $this->addReference("pinaColada", $pinaColada);
        $this->addReference("margarita", $margarita);
        $this->addReference("sexOnTheBeach", $sexOnTheBeach);
        $this->addReference("caipirinha", $caipirinha);
        $this->addReference("cosmopolitan", $cosmopolitan);
        $this->addReference("blueLagoon", $blueLagoon);
        $this->addReference("tequilaSunrise", $tequilaSunrise);
        $this->addReference("boraBora", $boraBora);
        $this->addReference("zombie", $zombie);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}