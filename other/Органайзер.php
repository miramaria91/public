<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //доступы к базе, настрокйка кодировки   
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        $host = 'localhost';
        $user = 'root';
        $password = '42244224';
        $db_name = 'test';
        $link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");
        // текущий день недели
        $dayNow = date('w', time());
        ?>
        <h1>Органайзер</h1>
        <?php
        // Высчитываем текущую дату и выводим в заданном формате, где месяц в родительном падеже
        $dateToday = date('d.n.Y', time());
        $monthArr = ['декабря', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября'];
        $dateNowArr = explode('.', $dateToday);
        foreach ($monthArr as $key => $elem) {
            if ($key == $dateNowArr[1]) {
                $monthName = $elem;
            }
        }
        $today = 'Сегодня ' . $dateNowArr[0] . ' ' . $monthName . ' ' . $dateNowArr[2] . ' ' . 'года';
        ?>
        <?php
        // Если выбрали день недели, добавили таск и нажали на сохранить, таск попадает в базу
        if (!empty($_GET['week']) and ! empty($_GET['text'])) {
            // Затираем из БД запись на выбранный день недели
            $query = 'DELETE FROM organizer WHERE weekday = ' . $_GET['week'];
            mysqli_query($link, $query) or die(mysqli_error($link));
            // Добавляем в БД новую запись на выбранный день недели
            $query = 'INSERT INTO organizer (weekday, text) VALUES (' . $_GET['week'] . ', "' . $_GET['text'] . '")';
            mysqli_query($link, $query) or die(mysqli_error($link));
            header('location: index.php');
        }
        ?>
        <a href="index.php?week= 1">Понедельник</a>
        <a href="index.php?week= 2">Вторник</a>
        <a href="index.php?week= 3">Среда</a>
        <a href="index.php?week= 4">Четверг</a>
        <a href="index.php?week= 5">Пятница</a>
        <a href="index.php?week= 6">Суббота</a>
        <a href="index.php?week= 0">Воскресенье</a>
        <p><?php echo $today; ?></p> 
        <br>
        <form action="index.php" method="GET">       
            <textarea name="text">
                <?php
                // выводим сохраненое в БД значение текстареа
                //если выбрали день недели по ссылке из меню     
                if (empty($_GET['text']) and ! empty($_GET['week'])) {
                    $query = 'SELECT * FROM organizer WHERE weekday = ' . $_GET['week'];
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    $row = mysqli_fetch_assoc($result);
                    echo $row['text'];
                }
                //если зашли на страницу впервые     
                if (empty($_GET)) {
                    $query = 'SELECT * FROM organizer WHERE weekday = ' . $dayNow;
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    $row = mysqli_fetch_assoc($result);
                    echo $row['text'];
                    $_GET['week'] = $dayNow;
                }
                ?>
            </textarea><br>        
            <input type="submit" value="Сохранить">
            <input type="hidden" name="week" value="<?php echo $_GET['week']; ?>">
        </form>
</html>