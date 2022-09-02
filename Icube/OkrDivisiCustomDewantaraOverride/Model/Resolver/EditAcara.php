<?php

declare(strict_types=1);

namespace Icube\OkrDivisiCustomDewantaraOverride\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Icube\OkrDivisiCustomDewantaraOverride\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantaraOverride\Model\PesertaFactory;

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
        if( isset($input['nama']) ) {
            $acara->setNama($input['nama']);
        }

        if( isset($input['pemateri']) ){
            $acara->setPemateri($input['pemateri']);
        }

        if( isset($input['tanggal_acara']) ){
            $acara->setTanggalAcara($input['tanggal_acara']);
        }

        # save data
        $acara->save();

        $peserta = $this->pesertaFactory->create();
        $pesertaResult = $peserta->getCollection()->addFieldToFilter('id_acara',$acara->getId())->load();

        $result = array(
            'id'                => $acara->getId(),
            'nama'              => $acara->getNama(),
            'pemateri'          => $acara->getPemateri(),
            'peserta'           => $pesertaResult,
            'tanggal_acara'     => $acara->getTanggalAcara()
        );

        return $result;
    }
}
