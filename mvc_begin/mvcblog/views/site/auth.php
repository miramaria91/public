<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MYBlog</title>   
        <link href="/mvcblog/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/mvcblog/template/css/signin.css" rel="stylesheet">
        <link rel="stylesheet" href="/mvcblog/template/css/fonts.css" />
    </head>
    <body>
        <form class="form-signin" method="POST">        
            <h2 class="form-signin-heading">Авторизация</h2>          
            <label for="inputEmail" class="sr-only"></label>
            <input name="login" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>      
            <label for="inputPassword" class="sr-only"></label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>       
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>          
        </form>
        <?php include ROOT . '/views/layouts/footer.php'; ?>

