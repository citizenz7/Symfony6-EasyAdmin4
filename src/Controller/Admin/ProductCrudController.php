<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class ProductCrudController extends AbstractCrudController
{
    // On crée des constantes qui sont reprises dans le configureFields...
    //public const ACTION_DUPLICATE = 'duplicate';
    public const ACTION_EDIT = 'edit';
    public const PRODUCTS_BASE_PATH = 'uploads/images/products';
    public const PRODUCTS_UPLOAD_DIR = 'public/uploads/images/products';

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     $duplicate = Action::new(self::ACTION_DUPLICATE)
    //         ->linkToCrudAction('duplicateProduct')
    //         // on peut attribuer des class CSS aux boutons...
    //         ->setCssClass('btn btn-info');

    //     // on crée un bouton duplicate...
    //     return $actions
    //     ->add(Crud::PAGE_EDIT, $duplicate)
    //     // On peut réordonner les boutons
    //     ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    // }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('image')
                ->setBasePath(self::PRODUCTS_BASE_PATH)
                ->setUploadDir(self::PRODUCTS_UPLOAD_DIR),
            // On récupère les catégories actives !
            AssociationField::new('category')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            }),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            BooleanField::new('active'),

        ];
    }

    // CreatedAt est défini dans le AdminSubscriber
    // public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    // {
    //     if (!$entityInstance instanceof Product) return;

    //     $entityInstance->setCreatedAt(new \DateTimeImmutable);

    //     // Permet de faire persist et flush en 1 ligne de code :
    //     parent::persistEntity($em, $entityInstance);
    // }

    // UpdatedAt est défini dans le AdminSubscriber
    // public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    // {
    //     if (!$entityInstance instanceof Product) return;
    //     $entityInstance->setUpdatedAt(new \DateTimeImmutable);
    //     // Permet de faire persist et flush en 1 ligne de code :
    //     parent::updateEntity($em, $entityInstance);
    // }

    // public function duplicateProduct(
    //     AdminContext $context, 
    //     AdminUrlGenerator $adminUrlGenerator,
    //     EntityManagerInterface $em
    // ): Response {
    //     /** @var Product $product */
    //     $product = $context->getEntity()->getInstance();

    //     $duplicateProduct = clone $product;

    //     parent::persistEntity($em, $duplicateProduct);

    //     $url = $adminUrlGenerator->setController(self::class)
    //         ->setAction(Action::DETAIL)
    //         ->setEntityId($duplicateProduct->getId())
    //         ->generateUrl();

    //     return $this->redirect($url);
    // }
}
