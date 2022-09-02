<?php 

namespace Icube\Training\Controller\TrainingNich;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Icube\Training\Helper\Data;

class Index extends Action
{

	protected $resultPageFactory;
    protected $helper;
	
	public function __construct(
		Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Data $helper
	){
		$this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;

		parent::__construct($context);

	}
	public function execute()
	{
		// echo 'Horaaay! Controller!';
		// die('Icube training controller!');

        $data_helper = $this->helper->getDataTrainingHelper();
		$resultPage = $this->resultPageFactory->create();
        return $resultPage;
	}

}
