<?php
namespace Icube\Training\Controller\Adminhtml\Trainee;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

// get data from store
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $scopeConfig;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        $storeValue = $this->scopeConfig->getValue("training_setting/general/training_header",ScopeInterface::SCOPE_STORE);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Trainee List'), __('Trainee List - ' . $storeValue));
        $resultPage->getConfig()->getTitle()->prepend(__('Trainee List Page' . $storeValue));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Icube_Trainee::trainee_list');
    }
}
