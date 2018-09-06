<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/9/4
 * Time: 11:41
 */

namespace Swimtobird\Jobs\Process;

use Swimtobird\Jobs\Worker;

trait StartProcess
{
    public function start()
    {
        $work = new Worker();
        $work->initChildProcess();
        $work->initSignal();
    }
}
