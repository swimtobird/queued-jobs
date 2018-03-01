<?php

namespace Swimtobird\Jobs;

class Utils
{
    /**
     * 循环创建目录.
     *
     * @param mixed $path
     * @param mixed $recursive
     * @param mixed $mode
     */
    public static function mkdir($path, $mode=0777, $recursive=true)
    {
        if (!is_dir($path)) {
            mkdir($path, $mode, $recursive);
        }
    }

    public static function catchError($logger, $exception)
    {
        $error  = '错误类型：' . get_class($exception) . PHP_EOL;
        $error .= '错误代码：' . $exception->getCode() . PHP_EOL;
        $error .= '错误信息：' . $exception->getMessage() . PHP_EOL;
        $error .= '错误堆栈：' . $exception->getTraceAsString() . PHP_EOL;

        $logger->log($error, 'error');
    }
}
