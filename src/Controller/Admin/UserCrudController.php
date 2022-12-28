<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            ChoiceField::new('genre')->setChoices([
                'Homme' =>  'Homme',
                'Femme' =>  'Femme'
            ]),
            TextField::new('imageFile', 'Avatar')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('avatar', 'Photo')
                ->setBasePath('uploads/users/avatars')
                ->setUploadDir('public/uploads//users/avatars')
                ->setSortable(false)->hideOnForm(),
            TextEditorField::new('apropos')->hideOnIndex(),
            CountryField::new('pays'),
            TextField::new('ville'),
            TextField::new('adresse')->hideOnIndex(),
            ChoiceField::new('compte', 'Compte')->setChoices([
                'Administrateur' =>  'Administrateur',
                'Utilisateur' =>  'Utilisateur'
            ]),
            EmailField::new('email'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setSearchFields(['nom', 'prenom'])
            ->setPageTitle('index', 'Comptes utilisateurs')
            ->setPageTitle('new', 'Nouveau compte utilisateur')
            ->setPageTitle('edit', fn (User $user) => sprintf('Edition du compte <b>%s</b>', $user->getNom() . ' ' . $user->getPrenom()))
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(2)
            ->setDefaultSort(['created' => 'DESC'])
            //->setHelp('new', 'Exemple aide')
            //->renderContentMaximized(50)
            //->renderSidebarMinimized()
        ;
    }
}
