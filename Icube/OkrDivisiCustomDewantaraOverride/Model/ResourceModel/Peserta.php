<?php
namespace Icube\OkrDivisiCustomDewantaraOverride\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Peserta extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('icube_peserta_dewantara', 'id_peserta');
    }
}

?>