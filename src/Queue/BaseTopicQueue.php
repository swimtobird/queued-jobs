<?php

namespace Swimtobird\Jobs\Queue;

use Swimtobird\Jobs\JobObject;

abstract class BaseTopicQueue implements TopicQueueInterface
{
    //队列优先级
    const HIGH_LEVEL_1=1;
    const HIGH_LEVEL_2=2;
    const HIGH_LEVEL_3=3;
    const HIGH_LEVEL_4=4;
    const HIGH_LEVEL_5=5;

    public $topics = [];
    public $queue  = null;

    public static function getConnection(array $config)
    {
    }

    public function getTopics()
    {
        //根据key大到小排序，并保持索引关系
        arsort($this->topics);

        return array_values($this->topics);
    }

    public function setTopics(array $topics)
    {
        $this->topics = $topics;
    }

    public function push($topic, JobObject $job, $delay=0, $priority=self::HIGH_LEVEL_1, $expiration=0)
    {
    }

    public function pop($topic)
    {
    }

    public function len($topic)
    {
    }

    public function close()
    {
    }

    public function isConnected()
    {
    }
}
