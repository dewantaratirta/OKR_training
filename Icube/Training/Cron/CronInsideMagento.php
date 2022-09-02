<?php
namespace Icube\Training\Cron;

use \Icube\Training\Model\TraineeFactory;

class CronInsideMagento
{
    protected $helper;
    protected $traineeFactory;

	function __construct(TraineeFactory $traineeFactory)
	{
		$this->traineeFactory = $traineeFactory;
	}

	
	public function execute()
	{		
		//logic inside here
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/testcron.log');
        $logger = new \Zend_Log($writer);
         
        $logger->info('Log Trainee');
	    $logger->addWriter($writer);

		$name = "TestInsertCron " . date('H:i:s');
		$div  = "CronjobDivision";


		$trainee = $this->traineeFactory->create();
        $trainee->setName($name);
        $trainee->setDivision($div);
        $trainee->setCreatedAt( date('Y-m-d H:i:s')  ); 
        $trainee->save();

        return $this;
	}
    
}
