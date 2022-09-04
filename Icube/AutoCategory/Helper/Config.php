<?php

namespace Icube\AutoCategory\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;


/**
 * Helper for accessing store configuration, that contains:
 *  - enable
 *  - date
 *  - cron
 * Location: Backoffice >  Stores > Icube > Auto Category
 * 
 */
class Config extends AbstractHelper
{
    const ENABLE_CONFIG = 'auto_category_general/general/enable';
    const DATERANGE_CONFIG = 'auto_category_general/general/date_range';
    const CRON_CONFIG = 'auto_category_general/general/cron';

    /**
     * @var Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    function getEnableConfig()
    {
        return $this->scopeConfig->getValue(self::ENABLE_CONFIG, ScopeInterface::SCOPE_STORE);
    }

    function getDateRangeConfig()
    {
        return $this->scopeConfig->getValue(self::DATERANGE_CONFIG, ScopeInterface::SCOPE_STORE);
    }

}
