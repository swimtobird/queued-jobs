<?php

namespace Swimtobird\Jobs;

class Utils
{
    /**
     * 循环创建目录.
     *
     * @param mixed $dir
     * @param mixed $mode
     */
    public static function mkdir($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) {
            return true;
        }

        if (!mk_dir(dirname($dir), $mode)) {
            return false;
        }

        return @mkdir($dir, $mode);
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
