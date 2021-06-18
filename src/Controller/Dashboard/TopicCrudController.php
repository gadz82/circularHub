<?php

namespace App\Controller\Dashboard;

use App\Entity\Topic;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TopicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Topic::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $detailAction = Action::new('Detail', 'Dettaglio')->linkToCrudAction('detail');
        $actions->add(Crud::PAGE_INDEX, $detailAction);
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description')->hideOnIndex(),
            AssociationField::new('topicComments')->hideOnIndex()->hideOnForm(),
            AssociationField::new('topicParticipations')->hideOnIndex()

        ];
    }

}
