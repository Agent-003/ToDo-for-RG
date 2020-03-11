<?php

namespace App\Loader;

class DatabaseLoader
{
    public function __invoke(array $databaseConfig)
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s',
            $databaseConfig['host'],
            $databaseConfig['database_name']
        );
        return new \PDO($dsn, $databaseConfig['user'], $databaseConfig['password']);
    }
}