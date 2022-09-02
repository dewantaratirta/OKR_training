<?php
namespace Icube\Training\Model\ResourceModel\Trainee\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

// Extend Data Provider
class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    /**
     * Initialize dependencies.
     *
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'icube_trainee', // tabel disesuaikan
        $resourceModel = \Icube\Training\Model\ResourceModel\Trainee::class //resource model
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        # untuk menambahkan join di table lain

        // $this->getSelect()->joinLeft(
        //     ['customer' => $this->getTable('customer_entity')],
        //     'main_table.name = customer.firstname',
        //     ['email']
        // );
        // var_dump($this->getSelect()->__toString());die();
    }
}

