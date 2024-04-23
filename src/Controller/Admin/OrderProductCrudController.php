<?php

namespace App\Controller\Admin;

use App\Entity\OrderProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class OrderProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderProduct::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('products')->autocomplete(),
            
            AssociationField::new('orders')->autocomplete(),
        //    AssociationField::new('materials')->setSortProperty('name'),
        //    AssociationField::new('services')->setSortProperty('name')      
       
       
         ];

        
    }
}
