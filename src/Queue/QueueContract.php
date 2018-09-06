<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/8/31
 * Time: 14:49
 */

namespace Swimtobird\Jobs\Queue;

interface QueueContract
{
    public function push($job, $data = '', $queue = null);

    public function pop($queue = null);

    public function later($delay, $job, $data = '', $queue = null);

    public function getConnectionName();

    public function setConnectionName($name);
}
