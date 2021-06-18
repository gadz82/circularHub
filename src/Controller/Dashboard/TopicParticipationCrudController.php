<?php

namespace App\Controller\Dashboard;

use App\Entity\TopicParticipation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TopicParticipationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TopicParticipation::class;
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
