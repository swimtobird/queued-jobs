<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/9/3
 * Time: 17:06
 */

namespace Swimtobird\Jobs;

use Swimtobird\Jobs\Process\Process;

class Worker
{
    use Process;

    public function initChildProcess()
    {
        for ($i = 0; $i < $this->config['worker_num']; $i++) {
            $this->createChildProcess();
        }
    }
}
