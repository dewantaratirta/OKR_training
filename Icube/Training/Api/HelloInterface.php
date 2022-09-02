<?php
namespace Icube\Training\Api;

interface HelloInterface
{

/**
 * Function get Hello world
 *
 * @param string $name
 * @param string $division
 * 
 * @return \Icube\Training\Api\Data\HelloDataInterface
 */
    function getHelloWorld($name, $division = null);


    /**
     * Get Product from id
     *
     * @param int $id
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    function getProduct($id);


    /**
     *
     * @param string $name
     * @param string $division
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function createTrainee($name, $division);

    /**
     * @param int $id
     * @param string $name
     * @param string $division
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function updateTrainee($id, $name, $division);

    /**
     * @param int $id
     * @return boolean
     */
    function deleteTrainee($id);

    /**
     * @param int $id
     * @return \Icube\Training\Api\Data\TraineeInterface
     */
    function getTraineeById($id);


    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface
     * @return \Icube\Training\Api\Data\TraineeSearchResultInterface
     */
    function getTraineeBySearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}

