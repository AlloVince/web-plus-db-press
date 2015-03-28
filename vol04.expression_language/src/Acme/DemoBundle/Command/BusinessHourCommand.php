<?php
namespace Acme\DemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand As Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BusinessHourCommand extends Command
{
    protected function configure()
    {
        $this->setName('acme:business_hour');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $businessHourService = $this->getContainer()
            ->get('acme_demo.service.business_hour');
        $output->writeln($businessHourService->current());
    }
}
