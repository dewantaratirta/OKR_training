<?php

namespace Icube\OkrDivisiCustomDewantaraOverride\Model\Resolver;


use Icube\OkrDivisiCustomDewantaraOverride\Model\Resolver\DataProvider\AcaraDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Psr\Log\LoggerInterface;

class AcaraResolver implements ResolverInterface
{

    private $acaraDataProvider;
    private $logger;

    /**
     * @param DataProvider\News $NewsRepository
     */
    public function __construct(
        AcaraDataProvider $acaraDataProvider,
        LoggerInterface $logger
    ) {
        $this->acaraDataProvider = $acaraDataProvider;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        $search_text = $args['search'] ?? "";
        $filter_nama = $args['filter']['nama']['eq'] ?? "";
        $filter_pemateri = $args['filter']['pemateri']['eq'] ?? "";
        $pageSize = $args['pageSize'];
        $currentPage = $args['currentPage'];

        $result = $this->acaraDataProvider->getAcara( $search_text, $filter_nama , $filter_pemateri, $pageSize , $currentPage );

        return $result;
    }
}
