<?php

declare(strict_types=1);

namespace Icube\OkrDivisiCustomDewantara\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Icube\OkrDivisiCustomDewantara\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantara\Model\PesertaFactory;

class CreateAcaraPeserta implements ResolverInterface
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
        $acara->setNama($input['nama']);
        $acara->setPemateri($input['pemateri']);
        $acara->save();

        $listPeserta = [];
        
        foreach ($input['peserta'] as $key => $value) {
            $peserta = $this->pesertaFactory->create();
            $peserta->setNama($value['nama']);
            $peserta->setIdAcara($acara->getIdAcara());
            $peserta->save();
            $listPeserta[] = $peserta;
        }

        $result = array(
            'id'        => $acara->getId(),
            'nama'      => $acara->getNama(),
            'pemateri'  => $acara->getPemateri(),
            'peserta'   => $listPeserta
        );

        return $result;
    }
}
