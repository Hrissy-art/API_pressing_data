<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Country;
use App\Entity\District;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Entity\QualityProduct;
use App\Entity\Service;
use App\Entity\StatusOrder;
use App\Entity\Town;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
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
        $productsEntities = [];
        foreach ($mainCategories as $mainCategoryLabel => $subCategories) {
            $mainCategory = new Category();
            $mainCategory->setCategoryName($mainCategoryLabel);
            $manager->persist($mainCategory);

            foreach ($subCategories as $subCategoryLabel => $products) {
                $subCategory = new Category();
                $subCategory->setCategoryName($subCategoryLabel);
                $subCategory->setParent($mainCategory); // Set the parent category
                $manager->persist($subCategory);
     //products
                foreach ($products as $productName) {
                    $product = new Product();
                    $product
                        ->setProductName($productName)
                        ->setPrice($faker->randomFloat(2))
                        ->setCategory($subCategory);
                    $manager->persist($product);
                    $productsEntities[] = $product;
                }
                $mainCategory->addChild($subCategory);
            }
            $manager->persist($mainCategory);
        }

        $substances = ["Soie", "Coton", "Lin", "Polyester", "Cuir", "Autres"];
        $materialEntities = [];

        foreach ($substances as $substanceName) {
            $substance = new Material();
            $substance->setName($substanceName)
                ->setCoeff($faker->randomFloat(1, 1, 2));
            $manager->persist($substance);
            $materialEntities[] = $substance;

        }

        $countries = [];

        for ($i = 0; $i < 30; $i++) {

            $country = new Country();
            $country->setName($faker->realTextBetween(3, 10));
            $manager->persist($country);
            $countries[] = $country;
        }

        $districts = [];
        for ($i = 0; $i < 30; $i++) {
            $district = new District();
            $district->setName($faker->realTextBetween(3, 10));
            $district->setCountry($faker->randomElement($countries));
            $manager->persist($district);
            $districts[] = $district;

        }
        //towns 
        $towns = [];
        for ($i = 0; $i < 30; $i++) {
            $town = new Town();
            $town->setName($faker->realTextBetween(3, 10));
            $town->setZipCode($faker->randomNumber(5, 10));
            $town->setDistrict($faker->randomElement($districts));
            $manager->persist($town);
            $towns[] = $town;

        }

        // clients
        $clients = [];
        for ($i = 0; $i < 10; $i++) {
            $client = new Client();
            $client->setEmail($faker->email());
            $client->setPassword($this->userPasswordHasherInterface->hashPassword(
                $client,
                "test_pass"
            )
            );
            $client->setFirstName($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $client->setAdress($faker->address());
            $client->setTowns($faker->randomElement($towns));
            $client->setRoles(['ROLE_CLIENT']);

            $manager->persist($client);
            $clients[] = $client;
        }

        // employées
        $employees = [];
        for ($i = 0; $i < 3; $i++) {
            $employee = new Employee();
            $employee->setEmail($faker->email());
            $employee->setPassword($this->userPasswordHasherInterface->hashPassword(
                $employee,
                "test_pass"
            )
            );
            $employee->setFirstName($faker->firstName());
            $employee->setLastname($faker->lastName());
            $employee->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $employee->setAdress($faker->address());
            $employee->setIsAdmin($faker->boolean(3));
            $employee->setTowns($faker->randomElement($towns));
            $employee->setEmpNumber($faker->randomNumber('1', '5'));
            //    $employee->setRoles(['ROLE_ADMIN', 'ROLE_EMPLOYEE']);
            $manager->persist($employee);
            $employees[] = $employee;
        }
        // orders
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->setDateOrder($faker->dateTimeThisMonth());
            $order->setDateRender($faker->dateTimeThisMonth());
            $order->setClient($faker->randomElement($clients));

            $manager->persist($order);

        }
        //qualityproduct

        for ($i = 0; $i < 10; $i++) {
            $qualityProduct = new QualityProduct();
            $qualityProduct->setStatusName($faker->word);

            $manager->persist($qualityProduct);
        }
        //services
        $pressingServices = ['Dry Cleaning', 'Laundry', 'Ironing', 'Stain Removal', 'Alterations'];
        $pressingServiceEntities = [];

        // for ($i = 0; $i < 5; $i++) {
        //     $service = new Service();
        //     $service->setName($faker->word);
        //     $service->setCoeff($faker->randomFloat(2, 0.5, 2.0));

        //     $manager->persist($service);

        // }
        foreach ($pressingServices as $serviceName) {
            $pressingService = new Service();
            $pressingService->setName($serviceName);
            $pressingService->setCoeff($faker->randomFloat(2, 0.5, 2.0));

            $manager->persist($pressingService);
            $pressingServiceEntities[] = $pressingService;
        }
        //status Order
        $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        $statusOrderEntities = [];

        foreach ($statuses as $key => $status) {
            $statusOrder = new StatusOrder();
            $statusOrder->setStatus($status);

            $manager->persist($statusOrder);
            $statusOrderEntities[] = $statusOrder;
        }

        for ($i = 0; $i < 20; $i++) {
            $orderProduct = new OrderProduct();
            $orderProduct->setQuantity($faker->numberBetween(1, 10));
            $orderProduct->setProducts($faker->randomElement($productsEntities));
            $orderProduct->setMaterials($faker->randomElement($materialEntities));
            $orderProduct->setProductsQualities($qualityProduct);
            $orderProduct->setStatusesOrders($faker->randomElement($statusOrderEntities));
            $orderProduct->setServices($faker->randomElement($pressingServiceEntities));
            $orderProduct->setOrders($order);
            $manager->persist($orderProduct);
        }
        $manager->flush();
    }
}



// $users = [];
// $regularuser = new User ();
// $regularuser->setEmail("test@example.com");

// $regularuser->setPassword(
//     $this->userPasswordHasherInterface->hashPassword(
//         $regularuser, "test_pass"

//     )
// );
// $regularuser->setRoles(
//     ['ROLE_USER']
// );
// $manager->persist($regularuser);
// $manager->flush();
// $user = new User();
// $user->setEmail("admin@example.com");

// $user->setPassword(
//     $this->userPasswordHasherInterface->hashPassword(
//         $user, "test_pass"

//     )
// );
// $user->setRoles(
//     ['ROLE_ADMIN']
// );

// $manager->persist($user);
// $manager->flush();

// $users = [$regularuser, $user];