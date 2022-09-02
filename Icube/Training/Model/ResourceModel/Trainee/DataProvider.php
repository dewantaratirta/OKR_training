<?php
namespace Icube\Training\Model\ResourceModel\Trainee;

use Magento\Framework\App\Request\DataPersistorInterface;
use Icube\Training\Model\ResourceModel\Trainee\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    protected $dataPersistor;

    protected $date;
    
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor= $dataPersistor;
        $this->date = $date;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/get_data_on_backend.log');
        $logger = new \Zend_Log($writer);
        $logger->addWriter($writer);

        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }
        return $this->loadedData ?? null;

    }
}
