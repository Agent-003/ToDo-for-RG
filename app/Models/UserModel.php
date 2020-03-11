<?php

namespace App\Models;

use App\Application;
use App\Loader\DatabaseLoader;

class UserModel extends Model
{
    function validateLogin($user, $pass)
    {

    }

    function checkUserEmail($email, $password)
    {
        $result = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch(\PDO::FETCH_ASSOC);

        //var_dump();

        if ($user) {
            if ($user['password'] == $password) {

                $_SESSION['user_id'] = $user['id'];
                return true;
            } else {
                echo "Неправильный пароль";

            }
        } else {
            return "E-mail was not found";
        }
    }

    function checkEmail($email)
    {
        $result = $this->db->prepare('SELECT * FROM users WHERE users.email = :email');
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();
        return $count = $result->rowCount();
    }

    public function register($email, $password)
    {
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $this->db->prepare('INSERT INTO users (email, password) VALUES ( :email, :password)');
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        $result->execute();

        return true;

    }

}