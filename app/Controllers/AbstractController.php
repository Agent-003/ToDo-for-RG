<?php

namespace App\Controllers;


abstract class AbstractController
{

    public $pdo;
    public $model;
    private $baseTemplate;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    abstract function index();

    protected function render($contentTemplate, $layoutTemplate, $data = null)
    {
        $templateName = $this->baseTemplate . DIRECTORY_SEPARATOR . $layoutTemplate;
        include $templateName;
    }


    public function setTemplateDir(string $templateDir)
    {
        $this->baseTemplate = $templateDir;
    }
}
