<?php

function myAutoloader($className)
{
    $class_pieces = explode('\\', $className);
    $class_pieces[0]=strtolower($class_pieces[0]);

    if ($class_pieces[0] =='app') {
        require_once __DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $class_pieces) . '.php';
        return;
    }
}

spl_autoload_register('myAutoloader', true,true);