<?php
namespace Icube\OkrDivisiCustomDewantaraOverride\Model;
use Magento\Framework\Api\SearchCriteriaInterface;
use Icube\OkrDivisiCustomDewantaraOverride\Api\AcaraInterface;
use Icube\OkrDivisiCustomDewantaraOverride\Api\Data\DataAcaraResultInterface;
use Icube\OkrDivisiCustomDewantaraOverride\Model\PesertaFactory;
use Icube\OkrDivisiCustomDewantaraOverride\Model\AcaraFactory;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;



class AcaraModelInterface implements AcaraInterface
{

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder;
     */
    protected $filterBuilder;

    function __construct(
        PesertaFactory $pesertaFactory,
        AcaraFactory $acaraFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder
    )
    {
        $this->pesertaFactory = $pesertaFactory;
        $this->acaraFactory = $acaraFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface
     * @return \Icube\OkrDivisiCustomDewantaraOverride\Api\Data\DataAcaraResultInterface
     */
    function getAcaraBySearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        // $filters[] = $this->filterBuilder
        // ->setField('sku')
        // ->setConditionType('eq')
        // ->setValue('something')
        // ->create();
        // $this->searchCriteriaBuilder->addFilters($filters);
        
        // $searchCriteria = $this->searchCriteriaBuilder->create();
        // $searchResults = $this->productRepository->getList($searchCriteria);
        // return $searchResults->getItems();
    }
}
