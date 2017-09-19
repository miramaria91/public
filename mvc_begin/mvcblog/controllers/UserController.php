<?php

include_once ROOT . '/models/User.php';

class UserController {

    public function actionRegister() {

        if (!empty($_REQUEST['login']) and ! empty($_REQUEST['password'])) {
            $login = $_REQUEST['login'];
            $password = $_REQUEST['password'];
            $user = User::checkUser($login, $password);

            if (!empty($user)) {
                $salt = $user['salt'];
                $saltedPassword = md5($password . $salt);
                if ($saltedPassword == $user['password']) {
                    session_start();
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['name'] = $user['name'];
                    header('location:/mvcblog/admin');
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Неверно указан логин или пароль</div>';
            }
        }



        require_once (ROOT . '/views/site/auth.php');
        return true;
    }

}
