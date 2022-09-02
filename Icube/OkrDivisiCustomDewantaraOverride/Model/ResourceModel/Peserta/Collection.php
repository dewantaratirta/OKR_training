<?php
namespace Icube\OkrDivisiCustomDewantaraOverride\Model\ResourceModel\Peserta;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Icube\OkrDivisiCustomDewantaraOverride\Model\Peserta', 'Icube\OkrDivisiCustomDewantaraOverride\Model\ResourceModel\Peserta');
	}
}
