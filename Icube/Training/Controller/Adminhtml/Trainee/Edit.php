<?php
namespace Icube\Training\Controller\Adminhtml\Trainee;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/get_data_on_backend.log');
        // $logger = new \Zend_Log($writer);
        // $logger->addWriter($writer);

        $params = $this->getRequest()->getParams();

        $title = (isset($params['id'])) ? 'Trainee List Edit Page' : 'Trainee List Add New Page';
        $breadcrumb = (isset($params['id'])) ? 'Trainee List Edit' : 'Trainee List Add New';
        
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Trainee List'), __($breadcrumb));
        $resultPage->getConfig()->getTitle()->prepend(__($title));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Icube_Training::trainee_list');
    }
}