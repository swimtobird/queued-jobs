<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/9/4
 * Time: 11:26
 */

namespace Swimtobird\Jobs\Process;

use Symfony\Component\Console\Output\OutputInterface;

trait StopProcess
{
    public function stop($signal, OutputInterface $output)
    {
        $pid = (int)file_get_contents(__DIR__.'/../../runtime/pid/queue.pid');
        if ($pid && !\Swoole\Process::kill($pid, 0)) {
            $output->write('service is not running');
        }

        if (\Swoole\Process::kill($pid, $signal)) {
            $output->write('worker has been stopped success');
        } else {
            $output->write('worker has been stopped fail');
        }
    }
}
