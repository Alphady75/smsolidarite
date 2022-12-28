<?php

namespace App\Controller\Admin;

use App\Entity\PaiementEmail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class PaiementEmailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaiementEmail::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user', 'Investisseur'),
            AssociationField::new('demandePaiements', 'Demande de paiement'),
            EmailField::new('email'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Email de paiement')
            ->setEntityLabelInPlural('Emails de paiements')
            ->setSearchFields(['name', 'description'])
            ->setPageTitle('index', 'Emails de paiements')
            ->setPageTitle('new', 'Nouvelle email')
            ->setPageTitle('edit', fn (PaiementEmail $paiement) => sprintf("<b>Edition de l'email de paiement: %s</b>", $paiement->getEmail()))
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(2)
            ->setDefaultSort(['created' => 'DESC'])
            //->setHelp('new', 'Exemple aide')
            //->renderContentMaximized(50)
            //->renderSidebarMinimized()
        ;
    }
}
