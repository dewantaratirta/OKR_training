<?php
namespace Icube\OkrDivisiCustomDewantaraOverride\Model\ResourceModel\Acara;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Icube\OkrDivisiCustomDewantaraOverride\Model\Acara', 'Icube\OkrDivisiCustomDewantaraOverride\Model\ResourceModel\Acara');
	}
}
