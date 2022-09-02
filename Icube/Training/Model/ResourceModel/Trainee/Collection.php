<?php
namespace Icube\Training\Model\ResourceModel\Trainee;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Icube\Training\Model\Trainee', 'Icube\Training\Model\ResourceModel\Trainee');
	}
}
