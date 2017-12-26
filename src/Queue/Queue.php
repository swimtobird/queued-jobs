<?php

namespace Swimtobird\Jobs\Queue;

class Queue
{
    public static function getQueue($config)
    {
        $classQueue=$config['class'] ?? '\Swimtobird\Jobs\Queue\RedisTopicQueue';
        if (is_callable([$classQueue, 'getConnection'])) {
            return $classQueue::getConnection($config);
        }
        echo 'you must add queue config' . PHP_EOL;
        exit;
    }
}
