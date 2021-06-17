<?php

namespace App\Controller\Dashboard;
use App\Entity\AddressBook;
use App\Entity\AddressBookEntry;
use App\Entity\Group;
use App\Entity\Topic;
use App\Entity\TopicComment;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Dashboard
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }
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

    protected function updateUserEntity(User $entity, Form $editForm)
    {
        $postedPassword = $editForm->get('password')->getData();
        if (!empty($postedPassword)) {
            $entity->setPassword($this->userPasswordHasher->hashPassword($entity->getUser(), $postedPassword));
        }
        //parent::updateEntity($entity);
    }
}
