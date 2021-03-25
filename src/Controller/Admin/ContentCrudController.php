<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('abstract'),
            TextField::new('keywords'),
            AssociationField::new('contentType'),
            AssociationField::new('editor'),
            AssociationField::new('providers'),
            AssociationField::new('tags'),
          
        ];
    }
    
}
