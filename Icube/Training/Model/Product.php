<?php
namespace Icube\Training\Model;


class Product {

    function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log($writer);
         
        $logger->info('Informational message');

        return $result . ' Bekas';
    }

    // function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    // {
    //     return $result +2;
    // }

}

?>