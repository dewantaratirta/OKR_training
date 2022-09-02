<?php

declare(strict_types=1);

namespace Icube\OkrDivisiCustomDewantara\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Icube\OkrDivisiCustomDewantara\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantara\Model\PesertaFactory;

class EditAcara implements ResolverInterface
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

        $input = $args['input'];

        $acara = $this->acaraFactory->create();
        $acara = $acara->load($input['id']);

        # check input
        if( isset($input['acara']) ) {
            $acara->setNama($input['nama']);
        }
        if( isset($input['pemateri']) ){
            $acara->setPemateri($input['pemateri']);
        }

        # save data
        if( $acara->hasDataChanges() ) {
            $acara->save();
        }

        $peserta = $this->pesertaFactory->create();
        $pesertaResult = $peserta->getCollection()->addFieldToFilter('id_acara',$acara->getId())->load();

        $result = array(
            'id'        => $acara->getId(),
            'nama'      => $acara->getNama(),
            'pemateri'  => $acara->getPemateri(),
            'peserta'   => $pesertaResult
        );

        return $result;
    }
}
