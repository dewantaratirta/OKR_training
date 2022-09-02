<?php

declare(strict_types=1);

namespace Icube\OkrDivisiCustomDewantaraOverride\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Icube\OkrDivisiCustomDewantaraOverride\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantaraOverride\Model\PesertaFactory;

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
        $acara->setTanggalAcara($input['tanggal_acara']);
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
            'id'                => $acara->getId(),
            'nama'              => $acara->getNama(),
            'pemateri'          => $acara->getPemateri(),
            'peserta'           => $listPeserta,
            'tanggal_acara'     => $acara->getTanggalAcara()
        );

        return $result;
    }
}
