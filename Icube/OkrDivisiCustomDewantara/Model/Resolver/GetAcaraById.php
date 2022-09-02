<?php

declare(strict_types=1);

namespace Icube\OkrDivisiCustomDewantara\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Icube\OkrDivisiCustomDewantara\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantara\Model\PesertaFactory;

class GetAcaraById implements ResolverInterface
{

    public function __construct(
        AcaraFactory $acaraFactory,
        PesertaFactory $pesertaFactory
    ) {
        $this->acaraFactory = $acaraFactory;
        $this->pesertaFactory = $pesertaFactory;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        $id = $args['id'];
        $acara = $this->acaraFactory->create();
        $acara = $acara->load($id);

        $peserta = $this->pesertaFactory->create();
        $pesertaResult = $peserta->getCollection()->addFieldToFilter('id_acara',$id)->load();

        $result = array(
            'id'        => $acara->getIdAcara(),
            'nama'      => $acara->getNama(),
            'pemateri'  => $acara->getPemateri(),
            'peserta'   => $pesertaResult
        );
        return $result;
    }
}
