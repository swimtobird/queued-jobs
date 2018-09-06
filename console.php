#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Swimtobird\Jobs\Console\WorkConsole;
use Swimtobird\Jobs\Console\StopConsole;
use Swimtobird\Jobs\Console\RestartConsole;

$application = new Application();

foreach ([
             new WorkConsole(),
             new StopConsole(),
             new RestartConsole()
         ] as $console) {
    $application->add($console);
}

$application->run();