<?php

namespace App\Controller\Admin;

use App\Entity\DemandePaiement;
use App\Entity\PaiementEmail;
use App\Entity\Portefeuille;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

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
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="img/logo.jpg" width="100%" />')
            
            ->setFaviconPath('img/logo.jpg')

            ->setTranslationDomain('admin')

            ->renderContentMaximized(true)
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-chart-pie');

        yield MenuItem::section('Contenu');

        yield MenuItem::submenu('Demandes paiements', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', DemandePaiement::class)
                ->setAction(crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste', 'fa fa-list-alt', DemandePaiement::class)
        ]);

        yield MenuItem::submenu('Emails paiements', 'fa fa-envelope')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', PaiementEmail::class)
                ->setAction(crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste', 'fa fa-list-alt', PaiementEmail::class)
        ]);

        yield MenuItem::submenu('Portefeuille', 'fa fa-book')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Portefeuille::class)
                ->setAction(crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste', 'fa fa-list-alt', Portefeuille::class)
        ]);

        yield MenuItem::section('Actions');

        yield MenuItem::submenu('Compte utilisateurs', 'fa fa-users')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', User::class)
                ->setAction(crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste', 'fa fa-list-alt', User::class)
        ]);

        yield MenuItem::linkToUrl('Visiter le site web', 'fa fa-home', '/');
        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-power-off');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $user = $this->getUser();
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        //return parent::configureUserMenu($user)
        return UserMenu::new()
            // use the given $user object to get the user name
            ->setName($user->getNom() . ' ' . $user->getPrenom())
            // use this method if you don't want to display the name of the user
            ->displayUserName(false)

            // you can return an URL with the avatar image
            ->setAvatarUrl('https://...')
            ->setAvatarUrl($user->getAvatar())
            // use this method if you don't want to display the user image
            ->displayUserAvatar(false)
            // you can also pass an email address to use gravatar's service
            ->setGravatarEmail($user->getEmail())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                /*MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
                MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
                MenuItem::section(),*/
                MenuItem::linkToLogout('Déconexion', 'fa fa-sign-out'),
            ]);
    }
}
