<?php

namespace Swimtobird\Jobs\Action;

use Swimtobird\Jobs\JobObject;

interface ActionInterface
{
    public function init();

    public function start(JobObject $JobObject);
}
