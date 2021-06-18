<?php

namespace App\Controller\Dashboard;

use App\Entity\TopicAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TopicAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TopicAttachment::class;
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
