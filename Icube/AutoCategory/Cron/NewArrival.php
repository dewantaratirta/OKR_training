<?php

namespace Icube\AutoCategory\Cron;

use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\CategoryLinkRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Icube\AutoCategory\Helper\Config as IcubeHelperConfig;
use Magento\Catalog\Model\CategoryFactory;


class NewArrival
{

    /**
     * @var Magento\Catalog\Model\ResourceModel\Product\CollectionFactory 
     */
    protected $productCollectionFactory;

    /**
     * @var Magento\Catalog\Api\CategoryLinkManagementInterface
     */
    protected $categoryLinkManagementInterface;

    /**
     * @var Magento\Catalog\Api\CategoryLinkRepositoryInterface
     */
    protected $CategoryLinkRepositoryInterface;

    /**
     * @var Icube\AutoCategory\Helper\Config
     */
    protected $icubeHelperConfig;

    /**
     * @var Magento\Catalog\Model\CategoryFactory
     */
    protected $categoryFactory;


    /**
     * Init Object manager
     *
     * @return void
     */
    public function _init()
    {
        # get collection factory
        $this->productCollectionFactory = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(ProductCollectionFactory::class);

        # for assign product to category
        $this->categoryLinkManagementInterface = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(CategoryLinkManagementInterface::class);

        # for remove product from category
        $this->categoryLinkRepositoryInterface = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(CategoryLinkRepositoryInterface::class);

        # for remove product from category
        $this->icubeHelperConfig = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(IcubeHelperConfig::class);

        # get category id
        $this->categoryFactory = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(CategoryFactory::class);
    }

    function _log($string = '', $title = 'Cron Log', $target = '/var/log/cron.log')
    {
        $writer = new \Zend_Log_Writer_Stream(BP . $target);
        $logger = new \Zend_Log($writer);
        $logger->info('>>>>' . $title . ' <<<<');
        $logger->info($string);
        $logger->addWriter($writer);

        return $this;
    }


    public function execute()
    {
        $this->_init();
        $enable  = (int) $this->icubeHelperConfig->getEnableConfig();

        $this->_log('Current setting for new_arrival: ' . $enable);
        if (!$enable) return;

        # get id Category
        $collection = $this->categoryFactory
            ->create()->getCollection()
            ->addAttributeToFilter('name', 'New Arrivals')
            ->setPageSize(1);
        $newarrival_category_id = $collection->getFirstItem()->getId();

        # get date range
        $dateRange = (int) $this->icubeHelperConfig->getDateRangeConfig();
        $date = date('Y-m-d');

        $dateString = '';
        if ($dateRange > 0) {
            $dateString = '- ' . $dateRange . ' days';
        }
        $from = date('Y-m-d', strtotime($date . $dateString));

        # get product collection
        $productCollection = $this->productCollectionFactory
            ->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter(
                'created_at',
                ['gt' => $from]
            );

        foreach ($productCollection as $key => $val) {
            $productSku = $val->getSku();
            $categories = $val->getCategoryIds();

            $current_exclude_new_value = $val->getCustomAttribute('exclude_from_new')->getValue();
            if ($current_exclude_new_value == 1 and in_array($newarrival_category_id, $categories)) {
                $this->categoryLinkRepositoryInterface->deleteByIds($newarrival_category_id, $productSku);
            }

            if ($current_exclude_new_value == 0 and !in_array($newarrival_category_id, $categories)) {
                $categories[] = $newarrival_category_id;
                $this->categoryLinkManagementInterface->assignProductToCategories($productSku, $categories);
            }
        }
    }
}
