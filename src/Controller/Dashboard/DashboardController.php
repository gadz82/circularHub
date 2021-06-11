<?php

namespace App\Controller\Dashboard;
use App\Entity\AddressBook;
use App\Entity\AddressBookEntry;
use App\Entity\Group;
use App\Entity\Topic;
use App\Entity\TopicComment;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Dashboard
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CircularHub');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Organizer', 'fa fa-address-book', AddressBook::class);
        yield MenuItem::linkToCrud('Contatti', 'fa fa-bookmark', AddressBookEntry::class);
        yield MenuItem::linkToCrud('Topic', 'fa fa-fire', Topic::class);
        yield MenuItem::linkToCrud('Interventi', 'fa fa-bolt', TopicComment::class);
        yield MenuItem::linkToCrud('Gruppi Utenti', 'fa fa-users', Group::class);
        yield MenuItem::linkToCrud('Utenti', 'fa fa-user', User::class);

    }
}
