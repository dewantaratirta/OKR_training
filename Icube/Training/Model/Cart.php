<?php

namespace Icube\Training\Model;


/**
 * Plugin to extends Magento default Cart
 * @extends \Magento\Checkout\Model\Cart
 */
class Cart
{

    // public function beforeAddProduct(
    //     \Magento\Checkout\Model\Cart $subject,
    //     $productInfo,
    //     $requestInfo = null
    //     )
    // {
    //     $requestInfo['qty'] = 5;
    //     return array( $productInfo, $requestInfo );
    // }

    public function aroundAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        \Closure $proceed,
        $productInfo,
        $requestInfo = null
    )
    {
        $requestInfo['qty'] = 2;
        return $proceed($productInfo, $requestInfo);
    }

}

?>