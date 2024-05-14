<?php

namespace App\Controller\Admin;

use App\Entity\Players;
use Doctrine\ORM\Query\Expr\Select;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class PlayersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Players::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('pseudo'),
            AssociationField::new('game'),
            TextEditorField::new('palmares'),

            
        ];
    }
    
}
