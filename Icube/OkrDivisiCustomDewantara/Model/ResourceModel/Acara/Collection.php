<?php
namespace Icube\OkrDivisiCustomDewantara\Model\ResourceModel\Acara;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Icube\OkrDivisiCustomDewantara\Model\Acara', 'Icube\OkrDivisiCustomDewantara\Model\ResourceModel\Acara');
	}
}
