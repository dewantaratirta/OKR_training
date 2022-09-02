<?php
namespace Icube\Training\Block;
 
class TrainingBlock extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $objectManager;
	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        $data
    )
    {
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();  
    }
	
    public function getTraningSchedule() {
        echo 'hello world';
        $customerSession = $this->objectManager->get('Magento\Customer\Model\Session');
        $name = $customerSession->getCustomer()->getName();
        echo '<pre>'.$name.'</pre>';
        // var_dump($name);
        // exit;
        $cust = $this->customerFactory->create();
        $cust = $cust->load(1);
        return $cust->getName();
        return 'NOW: Magento Basic functionality';
    }
}
