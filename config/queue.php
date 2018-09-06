<?php

return [
    'pid_file' => __DIR__ . '/../runtime/pid/queue.pid',
    'log_file' => __DIR__ . '/../runtime/logs/application.log',
    'log_level' => 5,
    'worker_num' => 2,
    'process_name' => 'SwooleQueue',
    'queue' => [
        'driver' => '\Swimtobird\Jobs\Queue\RedisTopicQueue',
        'options' => [
            'host' => '10.0.75.1',
            'port' => 6379,
            'dbindex' => 0
        ],
    ],
];
