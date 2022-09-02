<?php
namespace Icube\OkrDivisiCustomDewantaraOverride\Api;
use Magento\Framework\Api\SearchCriteriaInterface;

interface AcaraInterface
{

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface
     * @return \Icube\OkrDivisiCustomDewantaraOverride\Api\Data\DataAcaraResultInterface
     */
    function getAcaraBySearchCriteria(SearchCriteriaInterface $searchCriteria);

}

