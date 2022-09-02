<?php
namespace Icube\Training\Api\Data;

 use Magento\Framework\Api\SearchResultsInterface;

interface TraineeSearchResultInterface extends SearchResultsInterface
{

    /**
     * Get item List
     *
     * @return \Icube\Training\Api\Data\TraineeInterface[]
     */
    function getItems();

    /**
     * Get item List
     *
     * @param \Icube\Training\Api\Data\TraineeInterface[] $items
     * @return $this 
     */
    function setItems( array $items );

}
?>