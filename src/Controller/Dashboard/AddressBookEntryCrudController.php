<?php

namespace App\Controller\Dashboard;

use App\Entity\AddressBookEntry;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AddressBookEntryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AddressBookEntry::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = parent::configureFields($pageName);
        $fields[] = AssociationField::new('addressBook');
        return $fields;
    }

}
