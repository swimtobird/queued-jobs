<?php

namespace Swimtobird\Jobs;

class Config
{
    private static $config=[];

    public static function setConfig($config)
    {
        self::$config=$config;
    }

    public static function getConfig()
    {
        return self::$config;
    }
}
