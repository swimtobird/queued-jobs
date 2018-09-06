<?php

namespace Swimtobird\Jobs\Console;

use Swimtobird\Jobs\Process\StartProcess;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WorkConsole extends Command
{
    use StartProcess;

    public function configure()
    {
        $this->setName('queue:work');

        $this->setDescription('Start swoole-jobs master and workers.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->start();
    }
}
