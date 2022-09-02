<?php
namespace Icube\Training\Block;
 
class Trainee extends \Magento\Framework\View\Element\Template
{
	protected $traineeFactory;
	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Icube\Training\Model\TraineeFactory $traineeFactory
    )
    {
        $this->traineeFactory = $traineeFactory;
        parent::__construct($context);
    }

    
    public function getTraineeData()
    {
        # get data from parameter
        $id = $this->getRequest()->getParam('id');

	    $trainee = $this->traineeFactory->create();
		$trainee->load($id);  

        return $trainee;
    }
	
    public function getTraineeName($id)
    {
	    $result = $this->traineeFactory->create();
		$result = $result->load($id);  
		return $result->getName();
    }
    
    public function getTraineeCollection()
    {
	    $result = $this->traineeFactory->create();
		$collection = $result->getCollection();        
		return $collection;
    }  

    public function getText() {
        return 'haloo apa kabar?';
    }
}
