<?php

namespace Swimtobird\Jobs\Queue;

use Swimtobird\Jobs\JobObject;

interface TopicQueueInterface
{
    public static function getConnection(array $config);

    /**
     * @return array a array of topics
     */
    public function getTopics();

    /**
     * @param array $topics
     */
    public function setTopics(array $topics);

    /**
     * @param $topic
     * @param $value
     * @param mixed $delay
     * @param mixed $priority
     * @param mixed $expiration
     */
    public function push($topic, JobObject $job, $delay, $priority, $expiration);

    /**
     * @param $topic
     *
     * @return mixed
     */
    public function pop($topic);

    /**
     * @param $topic
     *
     * @return int
     */
    public function len($topic);

    public function close();

    public function isConnected();
}
