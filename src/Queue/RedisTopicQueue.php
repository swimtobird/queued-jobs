<?php

namespace Swimtobird\Jobs\Queue;

use Swimtobird\Jobs\JobObject;

class RedisTopicQueue extends BaseTopicQueue
{
    /**
     * RedisTopicQueue constructor.
     * 使用依赖注入的方式.
     *
     * @param \Redis $redis
     */
    public function __construct(\Redis $redis)
    {
        $this->queue = $redis;
    }

    public static function getConnection(array $config)
    {
        try {
            $class = extension_loaded('redis') ? \Redis::class : \Predis\Client::class;
            $redis = new $class();
            $redis->connect($config['host'], $config['port']);
            if (isset($config['password']) && !empty($config['password'])) {
                $redis->auth($config['password']);
            }
            if (isset($config['db']) && !empty($config['db'])){
                $redis->select($config['db']);
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;

            return false;
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL;

            return false;
        }
        $connection = new self($redis);

        return $connection;
    }

    /*
     * push message to queue.
     *
     * @param [string] $topic
     * @param [sting]  $value
     * @param [int]    $delay    延迟毫秒
     * @param [int]    $priority 优先级
     * @param [int]    $expiration      过期毫秒
     */
    public function push($topic, JobObject $job, $delay=0, $priority=BaseTopicQueue::HIGH_LEVEL_1, $expiration=0)
    {
        if (!$this->isConnected()) {
            return;
        }

        return $this->queue->lPush($topic, serialize($job));
    }

    public function pop($topic)
    {
        if (!$this->isConnected()) {
            return;
        }

        $result = $this->queue->lPop($topic);

        return !empty($result) ? @unserialize($result) : null;
    }

    public function len($topic)
    {
        if (!$this->isConnected()) {
            return 0;
        }

        return (int) $this->queue->lSize($topic) ?? 0;
    }

    public function close()
    {
        if (!$this->isConnected()) {
            return;
        }

        $this->queue->close();
    }

    public function isConnected()
    {
        try {
            $this->queue->ping();
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;

            return false;
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL;

            return false;
        }

        return true;
    }
}
