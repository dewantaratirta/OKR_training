<?php
namespace Icube\Training\Model;

use \Icube\Training\Api\HelloInterface;

class Hello implements HelloInterface
{

    protected $productFactory;
    protected $helloDataFactory;
    protected $traineeFactory;

    function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Icube\Training\Model\HelloDataFactory $helloDataFactory,
        \Icube\Training\Model\TraineeFactory $traineeFactory,
        \Icube\Training\Api\Data\TraineeSearchResultInterfaceFactory $searchResultFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->productFactory = $productFactory;    
        $this->helloDataFactory = $helloDataFactory;    
        $this->traineeFactory = $traineeFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    function getHelloWorld($name, $division = null)
    {

        $helloData = $this->helloDataFactory->create();
        $helloData->setName($name);
        $helloData->setDivision($division);
        
        return $helloData;
    }


    /**
     * Get Product from id
     *
     * @param int $id
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    function getProduct($id)
    {
        $product = $this->productFactory->create()->load($id);
        return $product;
    }


    /**
     *
     * @param string $name
     * @param string $division
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function createTrainee($name, $division)
    {
        $trainee = $this->traineeFactory->create();
        $trainee->setName($name);
        $trainee->setDivision($division);
        $trainee->save();

        return $trainee;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $division
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function updateTrainee($id, $name, $division)
    {
        $trainee = $this->traineeFactory->create()->load($id);
        $trainee->setName($name);
        $trainee->setDivision($division);
        $trainee->save();

        return $trainee;
    }

    /**
     * @param int $id
     * @return boolean
     */
    function deleteTrainee($id)
    {
        $trainee = $this->traineeFactory->create()->load($id);
        $trainee->delete();

        return TRUE;
    }

    /**
     * @param int $id
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function getTraineeById($id)
    {
        $trainee = $this->traineeFactory->create()->load($id);

        return $trainee;
    }


    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface
     * @return \Icube\Training\Api\Data\TraineeSearchResultInterface
     */
    function getTraineeBySearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResultFactory = $this->searchResultFactory->create();
        $searchResultFactory->setSearchCriteria($searchCriteria);

        $collection = $this->traineeFactory->create()->getCollection();
        $this->collectionProcessor->process( $searchCriteria, $collection );

        $searchResultFactory->setTotalCount( $collection->getSize() );
        $searchResultFactory->setItems( $collection->getItems());

        return $searchResultFactory;
    }
    
}

?>