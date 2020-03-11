<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserModel;

class IndexController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $this->actionStart();
        } else {
            //$_SESSION['user_id']= New UserController->login();
            $this->render('user/login.php','layout/layout.php');
        }
    }

    public function actionStart()
    {
        $projects = new ProjectController($this->pdo);
        $data=$projects->getAllProjects();
        $this->render('index/index.php', 'layout/layout.php', $data);
    }
}