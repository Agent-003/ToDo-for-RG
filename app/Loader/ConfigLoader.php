<?php

namespace App\Loader;

use mysql_xdevapi\Exception;

class ConfigLoader
{
    public function __invoke(string $configPath)
    {
        if(!file_exists($configPath)){
            throw new \Exception("Config file not found");
        }
        return parse_ini_file($configPath, true);
    }
}