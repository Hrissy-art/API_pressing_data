<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\Service;
use App\Entity\StatusOrder;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use symfony\Component\Security\http\Attribute\IsGranted;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
       
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
        

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('API Pressing Data Master');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Produits', 'fa fa-home', Product::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud('Clients', 'fa fa-user', Client::class);
        yield MenuItem::linkToCrud('Employees', 'fa fa-user', Employee::class);
        yield MenuItem::linkToCrud('Services', 'fa fa-jug-detergent', Service::class);
        yield MenuItem::linkToCrud('Materiaux', 'fa fa-shirt', Material::class);
        yield MenuItem::linkToCrud('Status', 'fa fa-battery-three-quarters', StatusOrder::class);
        yield MenuItem::linkToCrud('Payment', 'fa fa-money', Payment::class);
        yield MenuItem::linkToCrud('Commandes', 'fa fa-folder', Order::class);
        yield MenuItem::linkToCrud('Séléctions', 'fa fa-check', OrderProduct::class);
        yield MenuItem::linkToCrud('users', 'fa fa-user', User::class);






        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
