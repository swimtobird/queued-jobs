<?php

namespace Swimtobird\Jobs\Action;

use Swimtobird\Jobs\Config;
use Swimtobird\Jobs\JobObject;
use Swimtobird\Jobs\Logs;
use Swimtobird\Jobs\Utils;

class SwooleJobsAction extends BaseAction
{
    private $logger=null;

    public function init()
    {
        $this->logger = Logs::getLogger(Config::getConfig()['logPath'] ?? []);
    }

    public function start(JobObject $JobObject)
    {
        $this->init();
        $jobClass =$JobObject->jobClass;
        $jobMethod=$JobObject->jobMethod;
        $jobParams=$JobObject->jobParams;
        try {
            $obj      =new $jobClass();
            if (is_object($obj) && method_exists($obj, $jobMethod)) {
                call_user_func_array([$obj, $jobMethod], $jobParams);
            } else {
                $this->logger->log('Action obj not find: ' . json_encode($JobObject), 'error');
            }
        } catch (\Throwable $e) {
            Utils::catchError($this->logger, $e);
        } catch (\Exception $e) {
            Utils::catchError($this->logger, $e);
        }

        $this->logger->log('Action has been done, action content: ' . json_encode($JobObject));
    }
}
