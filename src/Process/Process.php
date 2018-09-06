<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/9/3
 * Time: 15:52
 */

namespace Swimtobird\Jobs\Process;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait Process
{
    protected $workers;

    protected $m_pid;

    protected $config;

    /**
     * @var Logger
     */
    protected $log;

    public function __construct(array $config = [])
    {
        $this->initConfig($config);
        $this->initLog();

        $this->checkMasterProcess();
        $this->creatMasterProcess();
    }

    public function initConfig($config)
    {
        if (!$config) {
            $this->config = require_once(__DIR__ . "/../../config/queue.php");
        } else {
            $this->config = $config;
        }
    }

    public function initLog()
    {
        $this->mkDir($this->config['log_file']);
        $this->log = new Logger('process');
        $this->log->pushHandler(new StreamHandler($this->config['log_file'], Logger::WARNING));
    }

    public function initSignal()
    {
        \Swoole\Process::signal(SIGTERM, function ($signo) {
            $this->killMasterProcess();
        });
        \Swoole\Process::signal(SIGKILL, function ($signo) {
            $this->killMasterProcess();
        });
        \Swoole\Process::signal(SIGUSR1, function ($signo) {
        });
        \Swoole\Process::signal(SIGCHLD, function ($signo) {
        });
    }

    public function checkMasterProcess()
    {
        if ($pid = $this->getMasterProcess()) {
            if ($pid && @\Swoole\Process::kill($pid, 0)) {
                die('已有进程运行中,请先结束或重启' . PHP_EOL);
            }
        }
    }

    public function getMasterProcess()
    {
        return file_get_contents($this->config['pid_file']);
    }

    public function creatMasterProcess()
    {
        \Swoole\Process::daemon();
        $this->m_pid = getmypid();

        $this->mkDir($this->config['pid_file']);
        file_put_contents($this->config['pid_file'], $this->m_pid);

        $this->setProcessName($this->config['process_name']);
    }

    public function setProcessName($name)
    {
        swoole_set_process_name($name);
    }
    /**
     * 结束主进程
     */
    public function killMasterProcess()
    {
        $this->killChildProcess();
        unlink($this->config['pid_file']);
    }

    /**
     * 创建子进程
     */
    public function createChildProcess()
    {
        $child_process = new \Swoole\Process(function ($process) {
            //主进程如果不存在了，子进程退出
            if (!$this->masterProcessIsAlive()) {
                $this->exitChildProcess($process);
            }
            $this->log->info('worker is done!');
        });

        $this->saveChildProcess($child_process);
    }

    public function saveChildProcess(\Swoole\Process $process)
    {
        $pid = $process->start();
        $process->name($this->config['process_name'].":child");
        $this->workers[$pid] = $process;
    }

    public function masterProcessIsAlive()
    {
        return \Swoole\Process::kill($this->m_pid, 0);
    }

    /**
     * 退出子进程
     */
    public function exitChildProcess(\Swoole\Process $process)
    {
        $process->exit();
    }

    public function killChildProcess()
    {
        if ($this->workers) {
            foreach ($this->workers as $pid => $worker) {
                \Swoole\Process::kill($pid);
                unset($this->workers[$pid]);
            }
        }
    }


    private function mkDir($dir)
    {
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach ($parts as $part) {
            if (!is_dir($dir .= "$part/")) {
                mkdir($dir);
            }
        }
    }
}
