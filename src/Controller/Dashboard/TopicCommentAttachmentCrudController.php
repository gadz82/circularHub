<?php

namespace App\Controller\Dashboard;

use App\Entity\TopicCommentAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TopicCommentAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TopicCommentAttachment::class;
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
