<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Admin;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\QualityProduct;
use App\Entity\Service;
use App\Entity\StatusOrder;
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
            "Pour les Hommes et les Femmes" => [
                "Chemises" => [
                    "Chemise à manches courtes" => ["price" => 4,
                    "description" =>"Votre chemise à manches courtes préférée, impeccablement repassée, reflète notre savoir-faire traditionnel. Chez nous, vos vêtements sont traités avec le plus grand soin : notre équipe de professionnels du pressing prend soin de chaque détail de votre chemise avec dévouement et expertise.",
                "product_img" => "https://img.freepik.com/photos-gratuite/jeune-fille-russe-blonde-confiante-met-mains-taille-regardant-cote-isole-fond-violet-copie-espace_141793-65233.jpg?w=826&t=st=1710698700~exp=1710699300~hmac=bfd90b02891c1ea109a573a1dc16e938969aad45870ec64b558ac57a0e6ab443"],
                     "Chemise décontractée"=> [
                        "price"=> 5,
                "description"=> "Votre chemise décontractée préférée mérite un traitement de qualité, et c'est exactement ce que nous offrons. Avec notre expertise dans le domaine du pressing, nous traitons chaque chemise avec le plus grand soin, préservant sa douceur, sa forme et sa couleur d'origine.",
                "product_img" => "https://img.freepik.com/photos-gratuite/confiant-bel-homme-met-mains-taille-regardant-vers-bas-isole-mur-orange_141793-68176.jpg?w=826&t=st=1710698683~exp=1710699283~hmac=b0e8cc3e0bef7b543e7e2e020c41f56b05b21255a9f43eab0d722d38fa792ae0"
                     ], 
                    "Chemise formelle"=> ["price"=> 5,
                    "description"=> "Votre chemise formelle mérite un traitement de qualité, et c'est exactement ce que nous offrons. Avec notre expertise dans le domaine du pressing, nous traitons chaque chemise avec le plus grand soin, préservant sa douceur, sa forme et sa couleur d'origine.",
                    "product_img" => "https://img.freepik.com/photos-gratuite/chemise-blanche_1339-6375.jpg?w=900&t=st=1710698669~exp=1710699269~hmac=a46ba7b14a0f6538bea33c68acdaaa22581fbf04dfdaf458da7f1e748ed0985c"],
                ],

                "Pantalons" => [
                    "Jean"=>["price"=> 10,
                "description"=> "Votre jean préféré mérite un traitement de qualité, et c'est exactement ce que nous offrons. Avec notre expertise dans le domaine du pressing, nous traitons chaque jean avec le plus grand soin, préservant sa douceur, sa forme et sa couleur d'origine.",
                "product_img" => "https://img.freepik.com/photos-gratuite/details-du-tissu-blue-jeans_150588-37.jpg?w=360&t=st=1710698647~exp=1710699247~hmac=771ed4c547345c91036350fb4fdff3ee241357e8d43e0d63817b8ce1f03fdb51"
            ], 
                
                "Pantalon chino" => [
                    "price" => 15,
                "description"=>
                "Votre pantalon chino préféré mérite un traitement de qualité, et c'est exactement ce que nous offrons.le pantalon chino est parfait pour les journées chaudes. Il est polyvalent et peut être porté aussi bien au travail que lors de loisirs.",
                "product_img" => "https://img.freepik.com/photos-gratuite/nature-morte-dit-non-fast-fashion_23-2149669577.jpg?w=360&t=st=1710698627~exp=1710699227~hmac=adc1e2033e090d9e83dd09dd1d270d1d8d8176c73e487a191abd66c038724d0b"
            ], 
                
                "Pantalon de costume" => [
                    "price" => 20,
                "description" => "Votre pantalon de costume préféré mérite un traitement de qualité, et c'est exactement ce que nous offrons. Fabriqué à partir de tissu de costume haut de gamme, ce pantalon offre une coupe élégante et une sensation de confort toute la journée. Il est idéal pour les occasions spéciales et les événements formels.",
                "product_img" => "https://img.freepik.com/photos-gratuite/gros-plan-du-costume-masculin_1303-10303.jpg?w=900&t=st=1710698585~exp=1710699185~hmac=1aaf6168be4b85d0f4ed6d3b81aa8a31893a42a0eba19d7ad374dd0ef3153294"
            ]],

                "Pulls" => [
                    "Pull à motifs" => [
                        "price" => 5,
                "description" => "Le pull à motifs est un choix élégant pour ceux qui veulent ajouter une touche de style à leur tenue. Confectionné dans un tissu confortable et respirant, ce pull vous gardera au chaud tout en vous donnant un look tendance. Parfait pour les occasions décontractées ou les sorties entre amis.",
                "product_img" => "https://img.freepik.com/psd-gratuit/jumper-noel-tricote-blanc-rouge-isole-fond-transparent_125540-5314.jpg?w=900&t=st=1710698565~exp=1710699165~hmac=1b48d086af525f2d96f40f8d55bc8541b4a9994d14e83528be9ad849c7e27358"],

                 "Sweat à capuche" => ["price"=> 15,
                "description" => "Le sweat à capuche est un incontournable de la garde-robe décontractée. Conçu pour offrir confort et chaleur, ce sweat est parfait pour les journées fraîches ou les séances d'entraînement en plein air. Son style décontracté en fait un choix polyvalent pour toutes les occasions.",
                "product_img" => "https://img.freepik.com/photos-gratuite/femme-touchant-nez-doigts-sweat-capuche-orange-drole_176474-86746.jpg?w=900&t=st=1710698517~exp=1710699117~hmac=04ed433395b7f2cd9fef077df890bbba29d5e78cbed63ff0515697bf49d3e24a"], 


                "Pull col roulé" => ["price"=> 10,
                "description" => "Le pull col roulé est un classique intemporel qui ajoute une touche d'élégance à toute tenue. Confectionné dans un tissu doux et chaud, ce pull vous gardera confortablement au chaud lors des journées fraîches. Parfait pour les looks décontractés ou les occasions plus formelles.",
                "product_img" => "https://img.freepik.com/photos-gratuite/belle-femme-age-moyen-s-amusant_23-2149269532.jpg?w=900&t=st=1710698499~exp=1710699099~hmac=b9c9e9534d7f5473498fd2c48b3fbe864c23eaeaf3786e5134f06ade6830f694"]
            ]],
            
            "Pour les Femmes" => [
                "Robes" => [
                    "Robe d'été" => [
                    "price" => 15,
            "description"=> "La robe d'été est parfaite pour les journées chaudes et ensoleillées. Légère et fluide, elle vous gardera au frais tout en vous donnant un look estival élégant. Parfaite pour une journée à la plage, une promenade en ville ou une soirée décontractée entre amis.",
            "product_img" => "https://img.freepik.com/photos-gratuite/femme-robe-verte-plage_1303-10526.jpg?t=st=1710701139~exp=1710704739~hmac=05d258ac466f8768cea5d85d58eb75b6608b9ee7208c7afacfcf8fe7e403f292&w=360"
        ],
                 "Robe de soirée" => [
                    "price"=> 20,
                 "description"=> "La robe de soirée est un choix élégant pour les occasions spéciales. Conçue dans un tissu raffiné et ornée de détails sophistiqués, cette robe vous fera briller lors de vos soirées les plus mémorables. Parfaite pour les mariages, les cocktails ou les galas.",
                 "product_img" => "https://img.freepik.com/photos-gratuite/femme-dans-salle-bain_144627-35868.jpg?w=360&t=st=1710698458~exp=1710699058~hmac=07a39fbe9dc865dea5b1f63b58ac566d9c3d59596a22655318e92c24f35f6404"
                 ],
                  "Robe maxi" => [
                    "price"=> 30,
            "description"=> "La robe maxi est un choix polyvalent qui allie style et confort. Longue et fluide, elle est parfaite pour les journées décontractées ou les soirées habillées. Confectionnée dans un tissu léger et fluide, cette robe vous gardera élégante et confortable tout au long de la journée.",
            "product_img" => "https://img.freepik.com/photos-gratuite/elegante-jolie-femme-vetue-robe-maxi-bleue-mode-mode-posant-au-parc-ville_291049-197.jpg?w=360&t=st=1710698437~exp=1710699037~hmac=45f38d789cb2b2da99c7c345ffe50a03a1cabe200af9963785f33c4c775dc4f7"

                  ]
                ],
                "Jupes" => [
                    "Jupe crayon" =>  [ 
                        "price"=> 25,
                "description"=> "La jupe crayon est un classique intemporel qui ajoute une touche d'élégance à toute tenue. Moulante et flatteuse, elle met en valeur vos courbes tout en restant confortable à porter. Parfaite pour le travail, les réunions professionnelles ou les occasions habillées.",
                "product_img" => " https://img.freepik.com/photos-gratuite/vertical-court-belle-jeune-femme-joyeuse-posant-isole-portant-chemisier-blanc-formel-jupe-grise-tube-chaussures-talons-hauts-debout-posture-fermee-regardant-ailleurs-sourire-mignon_343059-4185.jpg?t=st=1710701475~exp=1710705075~hmac=2bc8309bcf98b8717748766f17fc6c81ea29e26aada477ecae9a6d2ad3159dfb&w=360"
            ], 
                "Jupe plissée" => [
                    "price" => 35,
                "description" =>"La jupe plissée est un choix chic et féminin pour toutes les occasions. Conçue dans un tissu léger et fluide, elle apporte une touche d'élégance à votre tenue. Portez-la avec un chemisier pour un look élégant au bureau ou avec un t-shirt pour un style décontracté en ville.",
                "product_img" => "https://img.freepik.com/vecteurs-libre/vecteur-illustration-tablier-vintage-remixe-partir-oeuvres-art-gertrude-lemberg_53876-115539.jpg?w=740&t=st=1710698396~exp=1710698996~hmac=c1b7851be5970ee6a07066de199de093e9c7c6849997853ef82d8350efd9feb4"], 

                "Jupe longue"=>[
                    "price"=> 25,
                "description"=> "La jupe longue est un incontournable de la garde-robe estivale. Fluide et aérienne, elle est parfaite pour les journées ensoleillées et les soirées douces d'été. Conçue dans un tissu léger et respirant, elle vous gardera élégante et confortable tout au long de la journée.",
                "product_img" => "https://img.freepik.com/photos-gratuite/portrait-mode-plein-air-ete-superbe-femme-brune-aux-cheveux-longs-maquillage-lumineux_291049-1883.jpg?w=360&t=st=1710698366~exp=1710698966~hmac=1d9b79ec6aa77e4f1f38f27a18d2d80ce54588ca3f28ed38a12981b61887a8be"]
                  ],
            ],
            "Pour les petits et pas que .." => [
                "T-shirts" => ["T-shirt imprimé" => ["price"=> 12,
                "description"=> "Le t-shirt imprimé est un choix amusant et coloré pour les enfants. Fabriqué dans un tissu doux et confortable, il est parfait pour jouer à l'extérieur ou se détendre à la maison. Avec ses motifs amusants et ses couleurs vives, ce t-shirt ajoutera une touche de joie à la garde-robe de votre enfant.",
                "product_img" => "https://img.freepik.com/photos-gratuite/coup-moyen-garcon-couche-herbe_23-2148263210.jpg?w=740&t=st=1710698344~exp=1710698944~hmac=2ccea05fe0e07c42a747a4fa5654c4c085fca448e72019cd7b6afed4911c7b66"], 
                "T-shirt à manches longues" => [
                    "price"=> 18,
                    "description"=> "Le t-shirt à manches longues est un essentiel de toute garde-robe d'enfant. Confortable et polyvalent, il est parfait pour toutes les saisons. Fabriqué dans un tissu doux et extensible, il offre une coupe confortable et une liberté de mouvement totale. Idéal pour les journées fraîches ou les activités en plein air.",
                    "product_img" => "https://img.freepik.com/photos-gratuite/garcon-blond-posant_23-2148022715.jpg?w=360&t=st=1710698311~exp=1710698911~hmac=d3828f7b0c94ad7e0dc8a0293269741079f35eee08ee3889b0cc8b031bca70b9"
                ], 
                "T-shirt basique"=>["price"=> 2,
                "description"=> "Le t-shirt basique est un incontournable de la garde-robe de tout enfant. Simple et polyvalent, il peut être porté avec n'importe quel bas pour un look décontracté et confortable. Fabriqué dans un tissu doux et respirant, il offre un confort optimal tout au long de la journée.",
                "product_img" => "https://img.freepik.com/photos-gratuite/garcon-mignon-petit-dans-t-shirt-blanc-portrait-jeans-bleu-bureau-rose_179666-312.jpg?w=900&t=st=1710698273~exp=1710698873~hmac=d51a9023b0f6d4d28479cff2da66d2cb061201a108eecee97405c27684fd6ed1"
                ]],
                "Shorts" => ["Short classique"=>["price"=> 3,
                "description"=> "Le short est un choix classique et polyvalent pour les enfants. Robuste et durable, il est parfait pour jouer à l'extérieur ou se détendre à la maison. Avec sa coupe décontractée et son style intemporel, il est facile à assortir avec n'importe quel haut pour un look décontracté et cool.",
                "product_img" => "https://img.freepik.com/photos-gratuite/vetements-bebe-pour-garcons-fond-bois_93675-132866.jpg?w=360&t=st=1710698253~exp=1710698853~hmac=5259ae6de82b30cfc67cd968880b0cd8d4fcede8ca04e4faa4642b479717f22b"], 
                "Short de sport"=>["price"=> 35,
                "description" => "Le short de sport est idéal pour les activités physiques et les jeux en plein air. Léger et respirant, il offre une liberté de mouvement totale et un confort optimal pendant l'effort. Conçu dans un tissu technique qui évacue l'humidité, il garde votre enfant au sec et à l'aise pendant toute son activité.",
                "product_img" => "https://img.freepik.com/photos-gratuite/portrait-garcon-peau-sombre-concentre-habille-chemise-blanche_343059-3649.jpg?t=st=1710697686~exp=1710701286~hmac=23bf0e189fdeafaa9524f95ab3675ad306422a2d9ae12b29b54e4be15afa3514&w=900"] 
            ],
        ]];

        // $productsEntities = [];
        $counter = 0;

        foreach ($mainCategories as $mainCategoryLabel => $subCategories) {
            $mainCategory = new Category();
            $mainCategory->setCategoryName($mainCategoryLabel);
            $manager->persist($mainCategory);

            foreach ($subCategories as $subCategoryLabel => $products) {
                $subCategory = new Category();
                $subCategory->setCategoryName($subCategoryLabel);
                $subCategory->setParent($mainCategory); 
                $manager->persist($subCategory);


     //products

    
                foreach ($products as $productName=>$productData) {
                    $product = new Product();
                    $product
                        ->setProductName($productName)
                        ->setPrice($productData['price'])
                        ->setDescription($productData['description'])
                        ->setProductImg($productData['product_img'])
                        ->setCategory($subCategory);
                    $manager->persist($product);
                    $productsEntities[] = $product;

                    $counter++;

                    // Vérifiez si le compteur atteint 10, si oui, sortez de la boucle
                    if ($counter >= 20) {
                        break;
                    }

                }
            
                $mainCategory->addChild($subCategory);
            }
            $manager->persist($mainCategory);
        }

        $substances = ["Soie", "Coton", "Lin", "Polyester", "Cuir"];
        $materialEntities = [];

        foreach ($substances as $substanceName) {
            $substance = new Material();
            $substance->setName($substanceName)
                ->setCoeff($faker->randomFloat(1, 1, 2));
            $manager->persist($substance);
            $materialEntities[] = $substance;

        }

        $payments = ["Carte de crédit", "Carte de débit", " PayPal"];
       

        foreach ($payments as $method) {
            $payment = new Payment();
            $payment->setPaymentMethod($method);

            $manager->persist($payment);
            $payments[] = $payment;

        }


        // clients
        $clients = [];
        for ($i = 0; $i < 10; $i++) {
            $client = new Client();
            $client->setEmail($faker->email());
            $client->setPassword(
                "test_pass"
            )
            // $client->setPassword($this->userPasswordHasherInterface->hashPassword(
            //     $client,
            //     "test_pass"
            // )
            ;
            $client->setFirstName($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $client->setAdress($faker->address());
            $client->setTown($faker->randomElement());
            $client->setStreetNumber($faker->randomNumber('1', '5'));
            $client->setDistrict($faker->randomElement());
            $client->setCountry($faker->randomElement());
            $client->setRoles(['ROLE_CLIENT']);

            $manager->persist($client);
            $clients[] = $client;
        }

        // employées
        $employees = [];
        for ($i = 0; $i < 3; $i++) {
            $employee = new Employee();
            $employee->setEmail($faker->email());
            // $employee->setPassword($this->userPasswordHasherInterface->hashPassword(
            //     $employee,
            //     "test_pass"
            // )
            $employee->setPassword((
            
                "test_pass"
            )
            );
            $employee->setFirstName($faker->firstName());
            $employee->setLastname($faker->lastName());
            $employee->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $employee->setAdress($faker->address());
            $employee->setTown($faker->randomElement());
            $employee->setStreetNumber($faker->randomNumber('1', '5'));
            $employee->setDistrict($faker->randomElement());
            $employee->setCountry($faker->randomElement());
            $employee->setEmpNumber($faker->randomNumber('1', '5'));
            // $employee->setIsAdmin($faker->boolean(3));

               $employee->setRoles(['ROLE_EMPLOYEE']);
            $manager->persist($employee);
            $employees[] = $employee;
        }
        
        //admin
        $admins = [];
        for ($i = 0; $i < 3; $i++) {
            $admin = new Admin();
            $admin->setEmail($faker->email());
            // $admin->setPassword($this->userPasswordHasherInterface->hashPassword(
            //     $admin,
            //     "test_pass"
            // )
            $admin->setPassword(
               
                "test_pass"
            )
            ;
            $admin->setFirstName($faker->firstName());
            $admin->setLastname($faker->lastName());
            $admin->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $admin->setAdress($faker->address());
            $admin->setTown($faker->randomElement());
            $admin->setStreetNumber($faker->randomNumber('1', '5'));
            $admin->setDistrict($faker->randomElement());
            $admin->setCountry($faker->randomElement());
            // $employee->setIsAdmin($faker->boolean(3));

            $admin->setRoles(['ROLE_ADMIN']);
            $manager->persist($admin);
            $admins[] = $admin;
        }
        // //qualityproduct

        // for ($i = 0; $i < 10; $i++) {
        //     $qualityProduct = new QualityProduct();
        //     $qualityProduct->setStatusName($faker->word);

        //     $manager->persist($qualityProduct);
        // }
        //services
        $pressingServices = ['Nettoyage à sec', 'Blanchisserie', 'Repassage', 'Enlèvement des taches', 'Retouches'];
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
        $statuses = ['En attente', 'En cours de traitement', 'Expédié', 'Livré', 'Annulé'];
        $statusOrderEntities = [];

        foreach ($statuses as $key => $status) {
            $statusOrder = new StatusOrder();
            $statusOrder->setStatus($status);

            $manager->persist($statusOrder);
            $statusOrderEntities[] = $statusOrder;
        }
        // orders
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->setDateOrder($faker->dateTimeThisMonth());
            $order->setDateRender($faker->dateTimeThisMonth());
            $order->setClient($faker->randomElement($clients));
            $order->setStatusOrder($faker->randomElement($statusOrderEntities));
            $order->setNumberOrder($faker->randomNumber);
            $order->setEmployee($employee);

            $manager->persist($order);

        }

        for ($i = 0; $i < 10; $i++) {
            $orderProduct = new OrderProduct();
            $orderProduct->setProducts($faker->randomElement($productsEntities));
            $orderProduct->setPayment($payment);
            $numMaterials = $faker->numberBetween(1, count($materialEntities));
            $selectedMaterials = $faker->randomElements($materialEntities, $numMaterials);
            foreach ($selectedMaterials as $material) {
                $orderProduct->addMaterial($material);
            }  
            // $orderProduct->setStatusesOrders($faker->randomElement($statusOrderEntities));
            $orderProduct->setOrders($order);
            // $orderProduct->
            $numServices = $faker->numberBetween(1, count($pressingServiceEntities));
    $selectedServices = $faker->randomElements($pressingServiceEntities, $numServices);
    foreach ($selectedServices as $service) {
        $orderProduct->addService($service);
    }
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