<?php


namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Controllers\IndexController;
use App\Models\UserModel;

class UserController extends AbstractController
{

    public $model;

    public function __construct($pdo)
    {
        $this->model = new UserModel($pdo);
    }

    public function index()
    {

    }

    public function login()
    {
        $this->render('user/login.php', 'layout/layout.php');
    }

    public function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = md5($_POST['password']);

            if ($this->model->checkUserEmail($email, $password)) {

                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index");
            }

        }
    }

    public function registration()
    {
        $index['title'] = 'Регистрация';
        $this->render('user/registration.php', 'layout/layout.php');
    }

    public function actionRegister()
    {
        $email = false;
        $password = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = md5($_POST['password']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode("Invalid Email ...");
            } else {
                if (($this->model->checkEmail($email)) == 0) {

                    if ($this->model->register($email, $password)){
                        $data['redirect'] = "../index";
                        echo json_encode($data);
                    }

                } else {
                    $data['error']="This email is already registered, Please try another email ...";
                    echo json_encode($data);
                }
            }

        }
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}