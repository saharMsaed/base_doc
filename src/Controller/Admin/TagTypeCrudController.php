<?php

namespace App\Controller\Admin;

use App\Entity\TagType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TagType::class;
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
