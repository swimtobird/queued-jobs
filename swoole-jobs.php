<?php

define('APP_PATH', __DIR__);
//ini_set('default_socket_timeout', -1);
date_default_timezone_set('Asia/Shanghai');

require APP_PATH . '/vendor/autoload.php';
$config = require_once APP_PATH . '/config.php';

$console = new Swimtobird\Jobs\Console($config);
$console->run();
