<?php
namespace Icube\Training\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputOption;

use \Magento\Framework\App\Action\Context;
use \Icube\Training\Model\TraineeFactory;


class SayHello extends Command
{

    const NAME = 'name';
    const DIV = 'div';

    public function __construct(TraineeFactory $traineeFactory)
    {
        $this->traineeFactory = $traineeFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('training:sayhello');
        $this->setDescription('Training command line'); 
        $this->addOption(
            self::NAME,
            null,
            InputOption::VALUE_REQUIRED,
            'Name'
        );

        $this->addOption(
            self::DIV,
            null,
            InputOption::VALUE_REQUIRED,
            'Div'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $name = $input->getOption(self::NAME);
        $output->writeln('<info>INFO MASSZEH '.$name.'</info>');
        $div = $input->getOption(self::DIV);
        $output->writeln('<info>My Division is '.$div.'</info>');
        $output->writeln('Hello world Icube');

        $trainee = $this->traineeFactory->create();
        $trainee->setName($name);
        $trainee->setDivision($div);
        $trainee->setCreatedAt( date('Y-m-d H:i:s')  ); 
        $trainee->save();


        // $output->writeln( print_r($this->traineeFactory, true) );
        return 1;
    }
}
?>