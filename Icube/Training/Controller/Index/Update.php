<?php 

namespace Icube\Training\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;

class Update extends Action
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
        $data = $this->getRequest()->getParams();

	    $trainee = $this->traineeFactory->create();
		$trainee->load($data['id']);
        $trainee->setName($data['name']);
        $trainee->setDivision($data['division']);
        $trainee->setCreatedAt( date('Y-m-d H:i:s') );


        if( $trainee->hasDataChanges() ){
            $trainee->save();
        }
		$this->_redirect('./training/', []);

		$resultPage = $this->resultPageFactory->create();
        return $resultPage;
	}

}
