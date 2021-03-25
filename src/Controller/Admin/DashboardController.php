<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Sheet;
use App\Entity\Content;
use App\Entity\TagType;
use App\Entity\ContentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Base Doc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('TagType', 'fas fa-list', TagType::class);
        yield MenuItem::linkToCrud('Tag', 'fas fa-list', Tag::class);
        yield MenuItem::linkToCrud('ContentType', 'fas fa-list', ContentType::class);        
        yield MenuItem::linkToCrud('Content', 'fas fa-list', Content::class);
        yield MenuItem::linkToCrud('Sheet', 'fas fa-list', Sheet::class);
    }
}
