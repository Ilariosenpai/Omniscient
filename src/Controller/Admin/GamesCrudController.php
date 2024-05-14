<?php

namespace App\Controller\Admin;

use App\Entity\Games;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class GamesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Games::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            TextField::new('plateform'),
            
        ];
    }
    
}
