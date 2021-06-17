<?php

namespace App\Controller\Dashboard;

use App\Entity\AddressBookEntry;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AddressBookEntryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AddressBookEntry::class;
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
