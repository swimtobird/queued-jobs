<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/8/31
 * Time: 14:31
 */

namespace Swimtobird\Jobs\Console;

use Swimtobird\Jobs\Process\StopProcess;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StopConsole extends Command
{
    use StopProcess;

    public function configure()
    {
        $this->setName('queue:stop');

        $this->setDescription('Wait all running workers smooth exit, please check swoole-jobs status for a while.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->stop(SIGKILL, $output);
    }
}
