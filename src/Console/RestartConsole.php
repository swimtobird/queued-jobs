<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/8/31
 * Time: 14:31
 */

namespace Swimtobird\Jobs\Console;

use Swimtobird\Jobs\Process\StartProcess;
use Swimtobird\Jobs\Process\StopProcess;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RestartConsole extends Command
{
    use StopProcess;
    use StartProcess;

    public function configure()
    {
        $this->setName('queue:restart');

        $this->setDescription('Stop, then start swoole-jobs master and workers.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('restarting...');

        $this->stop(SIGKILL, $output);

        sleep(3);

        $this->start();
    }
}
