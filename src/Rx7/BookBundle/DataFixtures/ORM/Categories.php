<?php
namespace Rx7\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rx7\BookBundle\Entity\Category;

class Categories implements FixtureInterface
{
	// Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $manager)
	{
		// Liste des noms de catégorie à ajouter
		$names = array('Affaires et économie', 'Bandes dessinées et Mangas', 'Cuisine', 'Développement personnel', 'Romans', 'Fantasy');

		foreach($names as $i => $name)
		{
			// On crée la catégorie
			$list_categories[$i] = new Category();
			$list_categories[$i]->setName($name);

			// On la persiste
			$manager->persist($list_categories[$i]);
		}

		// On déclenche l'enregistrement
		$manager->flush();
	}
}
