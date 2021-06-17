<?php

namespace App\Controller\Dashboard;

use App\Entity\AddressBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AddressBookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AddressBook::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
