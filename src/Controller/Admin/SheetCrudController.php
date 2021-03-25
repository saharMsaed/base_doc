<?php

namespace App\Controller\Admin;

use App\Entity\Sheet;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SheetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sheet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('status'),
            TextEditorField::new('description'),
            TextField::new('shortInfo'),
            DateField::new('publicationDate'),
            DateField::new('expirationDate'),
            AssociationField::new('content'),
        ];
    }
    
}
