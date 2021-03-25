<?php

namespace App\Controller\Admin;

use App\Entity\ContentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContentType::class;
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
