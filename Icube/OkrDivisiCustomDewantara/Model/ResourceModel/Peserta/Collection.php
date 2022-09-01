<?php
namespace Icube\OkrDivisiCustomDewantara\Model\ResourceModel\Peserta;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Icube\OkrDivisiCustomDewantara\Model\Peserta', 'Icube\OkrDivisiCustomDewantara\Model\ResourceModel\Peserta');
	}
}
