<?php

namespace App\Controller\Admin;

use App\Entity\DemandePaiement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DemandePaiementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandePaiement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user', 'Investisseur')->hideOnIndex(),
            ChoiceField::new('typeVirement')->setChoices([
                'Carte visa' =>  'Carte visa',
                'Email stripe' =>  'Email stripe'
            ]),
            MoneyField::new('montant', 'Montant')->setCurrency('XAF'),
            AssociationField::new('paiementEmail', 'Email de paeiment')->hideOnIndex(),
            BooleanField::new('statut', 'Statut'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Demande de paiement')
            ->setEntityLabelInPlural('Demandes de paiements')
            ->setSearchFields(['name', 'description'])
            ->setPageTitle('index', 'Demandes de paiements')
            ->setPageTitle('new', 'Nouvelle demande')
            ->setPageTitle('edit', fn (DemandePaiement $demande) => sprintf('<b>Edition de la demande n° %s</b>', $demande->getId()))
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(2)
            ->setDefaultSort(['created' => 'DESC'])
            //->setHelp('new', 'Exemple aide')
            //->renderContentMaximized(50)
            //->renderSidebarMinimized()
        ;
    }
}
