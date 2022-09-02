<?php
namespace Icube\Training\Observer;

use Magento\Framework\Event\ObserverInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ProductRenderer implements ObserverInterface
{

    function execute( \Magento\Framework\Event\Observer $observer )
    {
            $event = $observer->getEvent();
            $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
            $logger = new \Zend_Log($writer);
             
            $logger->info( print_r($event), TRUE);
            exit;
    }

}
?>