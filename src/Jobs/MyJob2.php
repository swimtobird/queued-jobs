<?php

namespace Swimtobird\Jobs\Jobs;

class MyJob2
{
    public static function test1($a, $b)
    {
        sleep(1);
        echo 'test1| title: ' . $a . ' time: ' . $b . PHP_EOL;
    }

    public function test2($a, $b, $c)
    {
        sleep(2);
        echo 'test2| title: ' . $a . ' time: ' . $b . ' ' . print_r($c, true) . PHP_EOL;
    }

    public function testError($a, $b)
    {
        //随机故意构造错误，验证子进程推出情况
        $i = mt_rand(0, 5);
        if ($i == 3) {
            echo '出错误了!!!' . PHP_EOL;
            try {
                $this->methodNoFind();
                new Abc();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
