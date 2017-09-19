<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Панель администратора</title>  
        <link href="/mvcblog/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/mvcblog/template/css/head.css" rel="stylesheet">
        <link rel="stylesheet" href="/mvcblog/template/css/fonts.css" />
    </head>
    <body>    
        <div class="container">
            <!--menu-->
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Панель администратора</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="logout.php">Выйти</a></li>  
                        </ul>
                    </div>
                </nav>
            </div>               
            <!--Таблица-->               
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Мои статьи</div>  
                </div>
                <div><a class="btn btn-default button" href="admin.php?val_but" role="button">Создать новую статью</a></div>
            </div>    
            <!--Кнопка добавления новой статьи-->
            <div class="row">
                <div class="newarticle">
                    <p>Cоздание новой статьи</p>
                    <form action="admin.php" method="POST">
                        <input type="text" name="name_create" class="form-control" placeholder="Название новой статьи"><br>
                        <textarea name="text_create" class="form-control" rows="6"></textarea><br>
                        <input class="btn btn-default" type="submit" value="Cоздать">
                    </form>
                </div>         
            </div>
            <div class="row">                     
                <div class="newarticle">
                    <p>Редактирование статьи</p>
                    <form action="admin.php" method="POST">
                        <input name="name_edit" type="text" class="form-control" value=""><br>
                        <textarea name="text_edit" class="form-control" rows="10"></textarea><br>
                        <input name="id" type="hidden" class="form-control" value="">
                        <input class="btn btn-default" type="submit" value="Cохранить">
                    </form>
                </div>         
            </div>    
            <div class="row">               
                <div class="header_article"></div>
                <div class="date_create"></div>
                <div class="text"></div>
                <div><a class="btn btn-default button" href="admin.php" role="button">Cвернуть</a></div>               
            </div>                   
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


