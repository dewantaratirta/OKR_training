<?php
namespace Icube\OkrDivisiCustomDewantara\Model;

class Acara extends \Magento\Framework\Model\AbstractModel
{
	// const CACHE_TAG = 'icube_training_trainee';

    protected function _construct()
    {
        $this->_init('Icube\OkrDivisiCustomDewantara\Model\ResourceModel\Acara');
    }

    // public function getIdentities()
    // {
    //     return [self::CACHE_TAG . '_' . $this->getId()];
    // }   
}
