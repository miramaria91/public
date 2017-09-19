<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MYBlog</title>   
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/head.css" rel="stylesheet">
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

        <div class="container">

            <!--МЕНЮ-->
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">MYBLog</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Главная <span class="sr-only">(current)</span></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="auth.php">Авторизация</a></li>  
                        </ul>
                    </div>
                </nav>
            </div>

            <!--ОТОБРАЖЕНИЕ СТАТЕЙ В ФОРМАТЕ ПРЕВЬЮ--> 
            <?php
            if(empty($_REQUEST['name'])){
            // количество строк в базе
            $query_count = 'SELECT COUNT(*) as count FROM articles WHERE id > 0';
            $result = mysqli_query($link, $query_count) or die(mysqli_error($link));
            $count_str = mysqli_fetch_array($result);
            $count = $count_str['count'];

            //количество заметок в предпросмотре  
            $otziv_num = 3;

            // количество страниц
            $pages = ceil($count / $otziv_num);

            // блок, формирующий массив [порядковый номер страницы => с какой строки в БД делать выборку на этой странице]
            for ($i = 2; $i <= $pages; $i++) {
                $arr[] = $i;
            }
            for ($i = 1; $i <= $count; $i++) {
                $arr2[] = $i;
            }
            $arr3 = (array_chunk($arr2, $otziv_num));
            for ($i = 0; $i <= count($arr) - 1; $i++) {
                $arr4[] = $arr3[$i][$otziv_num - 1];
            }
            $arr5 = array_combine($arr, $arr4);
            //формируем запрос в базу : 
            //когда мы нажимаем на ссылку, передаем параметр page
            $page = $_GET['page'];
            switch ($page) {

                //если параметр пустой, то есть страница открыта впервые, отображаем с первой строки из базы
                case 0: $query = 'SELECT * FROM articles WHERE id>0 ORDER BY id DESC LIMIT 0,' . $otziv_num;
                    break;
                //иначе формируем запросы с какой строки в БД на какой странице отображать заметки
                case 1: $query = 'SELECT * FROM articles WHERE id>0 ORDER BY id DESC LIMIT 0,' . $otziv_num;
                    break;
                case $page > 1 : $query = 'SELECT * FROM articles WHERE id>0 ORDER BY id DESC LIMIT ' . $arr5[$page] . ', ' . $otziv_num;
                    break;
            }

            //обрабатываем сформированный запрос в понятный вид массива $data
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row)
                ;

            //выводим данные из массива в предпросмотр
            foreach ($data as $key) {
                $text = $key['text'];
                $text_prev = substr($text, 0, 1200).'...';
                $date_create = $key['date_create'];
                $name = $key['name'];
                echo '<div class="row"><div class="col-lg-12">'
                . '<div class ="header_article"><a href="index.php?name='.$name.'">'. $name . '</a></div>'
                . '<div class ="date">' . $date_create . '</div>'
                . '<div class ="text">' . $text_prev . '</div>'
                . '<hr></div></div>';
            }

            // ПАГИНАТОР
            echo '<nav aria-label="Page navigation">'
            . '<ul class="pagination">';
            for ($i = 1; $i <= $pages; $i++) {
                echo '<li><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
            };
            echo '</ul></nav>';}
            
            
      // ЕСЛИ НАЖАЛИ НА ИМЯ ЗАМЕТКИ В ПРЕДПРОСМОТРЕ
     // Данные попадают в $_GET['name'], на основании них формируется запрос на выборку в БД и 
     // выводится результат.
     if (!empty($_GET['name'])) {          
         $query = 'SELECT * FROM articles WHERE name="'.$_GET['name'].'"'; 
         $result = mysqli_query($link, $query) or die(mysqli_error($link));
         for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
     ?>    
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_article"><?php echo $data[0]['name']?></div>
                    <div class="date_create"><?php echo $data[0]['date_create']?></div>
                    <div class="text"><?php echo $data[0]['text']?></div>
                    <div><a class="btn btn-default button" href="index.php" role="button">Назад</a></div>
                </div>
            </div>
            
     <?php } ?>


            
        </div>
    </body>
</html>
