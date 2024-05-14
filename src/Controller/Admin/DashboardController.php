<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Games;
use App\Entity\Image;
use App\Entity\News;
use App\Entity\Players;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\MakerBundle\Doctrine\EntityClassGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from )
        //
       return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Omniscient');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Event', 'fa fa-user', Event::class);
        yield MenuItem::linkToCrud('Games', 'fa fa-user', Games::class);
        yield MenuItem::linkToCrud('Image', 'fa fa-image', Image::class);
        yield MenuItem::linkToCrud('News', 'fas fa-list', News::class);
        yield MenuItem::linkToCrud('Players', 'fa fa-user', Players::class);

        // yield MenuItem::linkToUrl('Back to the website', 'fas fa-home', '/');
       
        
       
    }
}
