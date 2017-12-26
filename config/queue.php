<?php

return [
    //log目录
    'logPath' => APP_PATH . '/log',
    'logSaveFileApp' => 'application.log', //默认log存储名字
    'logSaveFileWorker' => 'crontab.log', // 进程启动相关log存储名字
    'pidPath' => APP_PATH . '/log',
    'processName' => ':swooleTopicQueue', // 设置进程名, 方便管理, 默认值 swooleTopicQueue
    //job任务相关
    'job' => [
        'topics' => [
            ['name' => 'MyJob', 'workerMinNum' => 1, 'workerMaxNum' => 20],
            ['name' => 'MyJob2', 'workerMinNum' => 3, 'workerMaxNum' => 10],
            ['name' => 'MyJob3', 'workerMinNum' => 1, 'workerMaxNum' => 10],
        ],
        // redis
        'queue' => [
            'class' => '\Swimtobird\Jobs\Queue\RedisTopicQueue',
            'host' => '10.0.75.1',
            'port' => 6379,
            //'password'=> 'pwd',
            //'db'=> '0',
        ],

        // rabbitmq
        // 'queue'   => [
        //     'class'         => '\Swimtobird\Jobs\Queue\RabbitmqTopicQueue',
        //     'host'          => '192.168.1.105',
        //     'user'          => 'guest',
        //     'pass'          => 'guest',
        //     'port'          => '5672',
        //     'vhost'         => '/',
        //     'exchange'      => 'php.amqp.ext',
        // ],

    ],
    //框架类型及装载类
    'framework' => [
        //可以自定义，但是该类必须继承\Swimtobird\Jobs\Action\BaseAction
        'class' => 'Swimtobird\Jobs\Action\SwooleJobsAction',

    ],

];
