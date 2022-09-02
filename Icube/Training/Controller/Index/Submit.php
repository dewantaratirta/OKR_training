<?php 

namespace Icube\Training\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;

class Submit extends Action
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
        $name       = $this->getRequest()->getPost('name');
        $division   = $this->getRequest()->getPost('division');
        
        // die('Data Submitted');
        // var_dump($name);die();

        $trainee = $this->traineeFactory->create();
        $trainee->setName($name);
        $trainee->setDivision($division);
        $trainee->setCreatedAt( date('Y-m-d H:i:s')  ); 
        $trainee->save();

		$this->_redirect('./training/', []);

		$resultPage = $this->resultPageFactory->create();
        return $resultPage;
	}

}
