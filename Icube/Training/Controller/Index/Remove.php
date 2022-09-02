<?php 

namespace Icube\Training\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;

class Remove extends Action
{
	protected $resultPageFactory;
	protected $traineeFactory;
	
	public function __construct(
		Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Icube\Training\Model\TraineeFactory $traineeFactory
	){
		$this->resultPageFactory = $resultPageFactory;
        $this->traineeFactory = $traineeFactory;
		parent::__construct($context);

	}


	public function execute()
	{
        $id       = $this->getRequest()->getParam('id');
        
        $trainee = $this->traineeFactory->create();
        $trainee->load($id);
        $trainee->delete();

		$this->_redirect('./training/', []);

		$resultPage = $this->resultPageFactory->create();
        return $resultPage;
	}

}
