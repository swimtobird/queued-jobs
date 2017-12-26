<?php

namespace Swimtobird\Jobs;

class JobObject
{
    public $uuid     ='';
    public $topic    ='';
    public $jobClass ='';
    public $jobMethod='';
    public $jobParams='';

    public function __construct($topic, $jobClass, $jobMethod, $jobParams)
    {
        $this->uuid     =uniqid($topic, true);
        $this->topic    =$topic;
        $this->jobClass =$jobClass;
        $this->jobMethod=$jobMethod;
        $this->jobParams=$jobParams;
    }
}
