<?php

namespace App\Controller\Admin;

use App\Entity\Portefeuille;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class PortefeuilleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Portefeuille::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            MoneyField::new('solde', 'Solde disponible')->setCurrency('XAF'),
            AssociationField::new('user', 'Investisseur'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Portefeuille')
            ->setEntityLabelInPlural('Portefeuilles')
            ->setSearchFields(['solde'])
            ->setPageTitle('index', 'Portefeuilles')
            ->setPageTitle('new', 'Ajouter une Portefeuilles')
            ->setPageTitle('edit', fn (Portefeuille $album) => sprintf('<b>Edition: %s</b>', $album->getSolde()))
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(2)
            ->setDefaultSort(['created' => 'DESC'])
            //->setHelp('new', 'Exemple aide')
            //->renderContentMaximized(50)
            //->renderSidebarMinimized()
        ;
    }
}
