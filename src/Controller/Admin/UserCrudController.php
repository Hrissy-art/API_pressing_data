<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;



class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('email'),
            ChoiceField::new('roles')->setChoices(['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_EMPLOYEE' => 'ROLE_EMPLOYEE','ROLE_CLIENT' => 'ROLE_CLIENT'])->allowMultipleChoices(),
            // TextField::new('discr'),

            TextField::new('firstName'),
            TextField::new('lastName'),
            TextEditorField::new('adress'),
            DateField::new('birthday'),
            TextField::new('streetNumber'),
            TextField::new('town'),
            TextField::new('district'),
            TextField::new('country')





        ];
    }
}
