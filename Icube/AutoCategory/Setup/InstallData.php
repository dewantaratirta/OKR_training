<?php

namespace Icube\AutoCategory\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Api\Data\EavAttributeInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterfaceFactory;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogEavAttribute;

class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    private $categoryRepositoryInterface;

    /**
     * @var \Magento\Catalog\Api\Data\CategoryInterfaceFactory;
     */
    private $categoryInterfaceFactory;

    /**
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryInterfaceFactory $categoryInterfaceFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        CategoryRepositoryInterface $categoryRepository,
        CategoryInterfaceFactory $categoryInterfaceFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->categoryRepositoryInterface = $categoryRepository;
        $this->categoryInterfaceFactory = $categoryInterfaceFactory;
    }


    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'exclude_from_new',
            [
                'label' => 'Exclude From New',
                'type' => 'int',
                'input' => 'boolean',
                'required' => false,
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'default' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::VALUE_YES,
                'global' => CatalogEavAttribute::SCOPE_GLOBAL,
                'visible' => true,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => false,
                'visible_in_advanced_search' => false,
                'used_in_product_listing' => true,
                'used_for_sort_by' => false,
            ]
        )
            ->addAttribute(
                Product::ENTITY,
                'sale',
                [
                    'label' => 'Sale',
                    'type' => 'int',
                    'input' => 'boolean',
                    'required' => false,
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                    'default' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::VALUE_YES,
                    'global' => CatalogEavAttribute::SCOPE_GLOBAL,
                    'visible' => true,
                    'user_defined' => true,
                    'searchable' => false,
                    'filterable' => false,
                    'visible_in_advanced_search' => false,
                    'used_in_product_listing' => true,
                    'used_for_sort_by' => false,
                ]
            );

        // - Sale Category
        // - New Arrivals
        $this->createCategory();

        $setup->endSetup();
    }

    public function createCategory()
    {
        $categoriesName = array('Sale Category', 'New Arrivals');
        foreach ($categoriesName as $categoryName) {
            /** new category instance **/
            $category = $this->categoryInterfaceFactory->create();
            $category->setName($categoryName);
            /** set root category as parent category **/
            $category->setParentId(2);
            $category->setIsActive(1);
            $category->setData('stores', [0]);
            $this->categoryRepositoryInterface->save($category);
        }
    }
}
