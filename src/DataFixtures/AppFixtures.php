<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Country;
use App\Entity\District;
use App\Entity\Material;
use App\Entity\Product;
use App\Entity\Town;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

       // Catégory
       $mainCategories = [
        "Hommes" => [
            "Chemises" => ["Chemise en coton", "Chemise à carreaux", "Chemise formelle"],
            "Pantalons" => ["Jean", "Pantalon chino", "Pantalon de costume"],
            "Pulls" => ["Pull en laine", "Sweat à capuche", "Pull col roulé"],
        ],
        "Femmes" => [
            "Robes" => ["Robe d'été", "Robe de soirée", "Robe maxi"],
            "Jupes" => ["Jupe crayon", "Jupe plissée", "Jupe longue"],
            "Ensembles" => ["Ensemble jupe et haut", "Ensemble pantalon et top", "Ensemble robe et veste"],
        ],
        "Enfants" => [
            "T-shirts" => ["T-shirt imprimé", "T-shirt à manches longues", "T-shirt basique"],
            "Shorts" => ["Short en jean", "Short de sport", "Short en coton"],
            "Pyjamas" => ["Pyjama deux pièces", "Chemise de nuit", "Combinaison pyjama"],
        ],
    ]; 
    
    foreach ($mainCategories as $mainCategoryLabel => $subCategories) {
        $mainCategory = new Category();
        $mainCategory->setCategoryName($mainCategoryLabel);
        $manager->persist($mainCategory);
    
        foreach ($subCategories as $subCategoryLabel => $products) {
            $subCategory = new Category();
            $subCategory->setCategoryName($subCategoryLabel);
            $subCategory->setParent($mainCategory); // Set the parent category
            $manager->persist($subCategory);
    
            foreach ($products as $productName) {
                $product = new Product();
                $product
                    ->setProductName($productName)
                    ->setPrice($faker->randomFloat(2))
                    ->setCategory($subCategory);
                $manager->persist($product);
                
            }
            $mainCategory->addChild($subCategory);
        }
        $manager->persist($mainCategory);
    }

    $substances =["Soie", "Coton", "Lin", "Polyester", "Cuir", "Autres"];

    foreach ($substances as $substanceName) {
        $substance = new Material();
        $substance->setName($substanceName)
                 ->setCoeff($faker->randomFloat(1, 1, 2));       
        $manager->persist($substance);
    }

    $countries = [];

    for ($i = 0; $i < 30; $i++){

    $country = new Country();
    $country->setName($faker ->realTextBetween(3,10));
    $manager->persist($country);
    $countries[] = $country;
}

$districts = [];
    for ($i = 0; $i < 30; $i++){
        $district = new District();
        $district->setName($faker->realTextBetween(3, 10));
        $district->setCountry($faker->randomElement($countries));
        $manager->persist($district);
        $districts[] = $district;
        
}

$towns = [];
for ($i = 0; $i < 30; $i++){
    $town = new Town();
    $town->setName($faker->realTextBetween(3, 10));
    $town->setZipCode($faker->randomNumber(5, 10));
    $town->setDistrict($faker->randomElement($districts));
    $manager->persist($town);
    $towns[] = $town;
    
    }

    $manager->flush();  }  }

