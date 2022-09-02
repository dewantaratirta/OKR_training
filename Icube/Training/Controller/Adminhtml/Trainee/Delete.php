<?php
namespace Icube\Training\Controller\Adminhtml\Trainee;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $traineeFactory;
    public $modelProfile;

    public function __construct(
        Context $context,
        \Icube\Training\Model\TraineeFactory $traineeFactory,
        PageFactory $resultPageFactory    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->traineeFactory = $traineeFactory;

    }

    public function execute()
    {
    	$id 		=  $this->getRequest()->getParam('id');
    	// var_dump($id);die();
        $result = $this->traineeFactory->create();
		$result = $result->load($id); 
		$result->delete();

		$this->messageManager->addSuccess(__("Successfull Delete Trainee !". $result->getName()));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

}
