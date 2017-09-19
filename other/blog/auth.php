<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MYBlog</title>   
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <link rel="stylesheet" href="css/fonts.css" />
    </head>
    <body>

        <?php
        // Доступы к БД
        $host = '127.0.0.1';
        $user = 'root';
        $password = '42244224';
        $db_name = 'blog';
        $link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");
        ?>

        <?php
        //АВТОРИЗАЦИЯ       
        // Если поля формы заполнены и данные отправлены
        if (!empty($_REQUEST['login']) and ! empty($_REQUEST['password'])) {
            $login = $_REQUEST['login'];
            $password = $_REQUEST['password'];
            // составляем запрос на получение из БД всей информации по пользователю
            $query = 'SELECT * FROM user WHERE login="' . $login . '"';
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $user = mysqli_fetch_array($result);
            // если полученный массив данных не пустой, значит пользователь существует
            if (!empty($user)) {
                //получаем соль пользователя, его пароль и формируем соленый пароль
                $salt = $user['salt'];
                $saltedPassword = md5($password . $salt);
                //если соленый пароль совпадает с тем, что ввел в форму пользователь, 
                //стартуем сессию и записываем в нее данные пользователя
                if ($saltedPassword == $user['password']) {
                    session_start();
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['name'] = $user['name'];
                } else {
                    echo '<div class="alert alert-danger" role="alert">Неверно указан логин или пароль</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Неверно указан логин или пароль</div>';
            }
        }
        ?>
        <?php
        if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
            header('location: admin.php');
        }
        ?>


        <form class="form-signin">        
            <h2 class="form-signin-heading">Авторизация</h2>          
            <label for="inputEmail" class="sr-only"></label>
            <input name="login" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>      
            <label for="inputPassword" class="sr-only"></label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>       
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>          
        </form>
    </div>      
</body>
</html>