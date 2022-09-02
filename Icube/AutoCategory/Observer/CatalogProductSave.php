<?php

namespace Icube\AutoCategory\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\CategoryLinkRepositoryInterface;

class CatalogProductSave implements ObserverInterface
{

    protected $categoryFactory;

    function __construct(
        CategoryFactory $categoryFactory
    ) {
        $this->categoryFactory = $categoryFactory;
    }

    function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $productSku = $product->getSku();
        $categories = $product->getCategoryIds();

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/cron.log');
        $logger = new \Zend_Log($writer);

        # get category id
        $collection = $this->categoryFactory->create()
            ->getCollection()
            ->addAttributeToFilter('name', 'Sale Category')
            ->setPageSize(1);
        $sale_category_id = $collection->getFirstItem()->getId();

        $collection = $this->categoryFactory
            ->create()->getCollection()
            ->addAttributeToFilter('name', 'New Arrivals')
            ->setPageSize(1);
        $newarrival_category_id = $collection->getFirstItem()->getId();

        # init Object Manager
        $categoryLinkManagementInterface = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(CategoryLinkManagementInterface::class);
        $categoryLinkRepositoryInterface = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(CategoryLinkRepositoryInterface::class);

        # sale logic (assign or remove to selected category)
        $currentSaleValue = $product->getCustomAttribute('sale')->getValue();
        if ($currentSaleValue == 1 and !in_array($sale_category_id, $categories)) {
            $categories[] = $sale_category_id;
            $categoryLinkManagementInterface->assignProductToCategories($productSku, $categories);
        }

        if ($currentSaleValue == 0 and in_array($sale_category_id, $categories)) {
            $categoryLinkRepositoryInterface->deleteByIds($sale_category_id, $productSku);
        }

        # new arrival logic
        $current_exclude_new_value = $product->getCustomAttribute('exclude_from_new')->getValue();
        if( $current_exclude_new_value == 1 and in_array($newarrival_category_id, $categories) ) {
            $categoryLinkRepositoryInterface->deleteByIds($newarrival_category_id, $productSku);
        }

        if( $current_exclude_new_value == 0 and !in_array($newarrival_category_id, $categories) ) {
            $categories[] = $newarrival_category_id;
            $categoryLinkManagementInterface->assignProductToCategories($productSku, $categories);
        }

    }
}
