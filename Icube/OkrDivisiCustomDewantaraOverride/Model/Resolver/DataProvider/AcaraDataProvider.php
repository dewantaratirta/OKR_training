<?php

namespace Icube\OkrDivisiCustomDewantaraOverride\Model\Resolver\DataProvider;

use Icube\OkrDivisiCustomDewantaraOverride\Model\AcaraFactory;
use Icube\OkrDivisiCustomDewantaraOverride\Model\PesertaFactory;

class AcaraDataProvider
{
    private $logger;
    protected $acaraFactory;
    protected $pesertaFactory;

    public function __construct(
        PesertaFactory $pesertaFactory,
        AcaraFactory $acaraFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->acaraFactory  = $acaraFactory;
        $this->pesertaFactory  = $pesertaFactory;
        $this->logger = $logger;
    }


    function getAcara($search_text, $filter_nama, $filter_pemateri, $pageSize, $currentPage)
    {
        $acara = $this->acaraFactory->create();
        $collection = $acara->getCollection();

        $currentPage = ($currentPage) ? $currentPage : 1; //default page 1
        //get values of current limit
        $pageSize = ($pageSize) ? $pageSize : 6; //default number of news per page is 6

        if ($search_text != "") {
            $collection->addFieldToFilter(
                array(
                    'nama', //attribute_1 with key 0
                    'pemateri', //attribute_2 with key 1
                ),
                array(
                    array('like' => '%' . $search_text . '%'), //condition for attribute_1 with key 0
                    array('like' => '%' . $search_text . '%'), //condition for attribute_2
                )
            );
        }

        if ($filter_nama !== "") {
            $collection->addFieldToFilter('nama', $filter_nama);
        }

        if ($filter_pemateri !== "") {
            $collection->addFieldToFilter('pemateri', $filter_pemateri);
        }

        $collection->setOrder('id_acara', 'ASC');
        $count = $collection->getSize();
        $total_pages =  ceil($count / $pageSize);
        $collection->setPageSize($pageSize)->setCurPage($currentPage);
        $resultAcara = [];
        $hitung = [];

        foreach ($collection as $key => $value) {
            $id = $value->getId();

            $peserta = $this->pesertaFactory->create();
            $pesertaResult = $peserta->getCollection()->addFieldToFilter('id_acara',$id)->load();

            $hitung[] = $key;
            $resultAcara[] = [
                'id'        => $id,
                'nama'      => $value->getNama(),
                'pemateri'  => $value->getPemateri(),
                'tanggal_acara'   => $value->getTanggalAcara(),
                'peserta'   => $pesertaResult
            ];
        }


        return [
            'items' => $resultAcara,
            'page_info' => [
                'page_size' => $pageSize,
                'current_page' => $currentPage,
                'total_pages' => $total_pages
            ],
            'total_count'   => count($resultAcara)
        ];

    }
}
