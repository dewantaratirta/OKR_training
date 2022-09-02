<?php
namespace Icube\Training\Helper;

use Magento\Framework\App\Action;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    // /**
    //  * @param Context $context
    //  */
    // public function __construct(Context $context)
    // {
    //     $this->_moduleManager = $context->getModuleManager();
    //     $this->_logger = $context->getLogger();
    //     $this->_request = $context->getRequest();
    //     $this->_urlBuilder = $context->getUrlBuilder();
    //     $this->_httpHeader = $context->getHttpHeader();
    //     $this->_eventManager = $context->getEventManager();
    //     $this->_remoteAddress = $context->getRemoteAddress();
    //     $this->_cacheConfig = $context->getCacheConfig();
    //     $this->urlEncoder = $context->getUrlEncoder();
    //     $this->urlDecoder = $context->getUrlDecoder();
    //     $this->scopeConfig = $context->getScopeConfig();
    // }

    public function __construct(
        
    )
    {
        
    }

    public function getDataTrainingHelper()
    {
        return 'This is data training helper';
    }

}

?>