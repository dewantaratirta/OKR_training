<?php
namespace Icube\OkrDivisiCustomDewantara\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Acara extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('icube_acara_dewantara', 'id_acara');
    }
}

?>