<?php

namespace App\Controller\Dashboard;

use App\Entity\TopicComment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TopicCommentCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return TopicComment::class;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('text')->hideOnIndex(),
            AssociationField::new('topic'),
            AssociationField::new('user')
        ];
    }

    /**
     * @param Filters $filters
     * @return Filters
     */
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('topic')
            ->add('user');
    }

}
