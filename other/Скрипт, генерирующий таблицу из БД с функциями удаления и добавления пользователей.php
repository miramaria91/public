<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        $host = 'localhost';
        $user = 'root';
        $password = '42244224';
        $db_name = 'test';
        $link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");

        if (!empty($_REQUEST['del_id'])) {
            $query = 'DELETE FROM workers WHERE id = ' . $_REQUEST['del_id'];
            echo $query;
            mysqli_query($link, $query) or die(mysqli_error($link));
            echo 'Пользователь удален';
        }

        if (!empty($_REQUEST['name']) and ! empty($_REQUEST['age']) and ! empty($_REQUEST['salary'])) {
            $query = 'INSERT INTO workers (name, age, salary) VALUES ("' . $_REQUEST['name'] . '",' . $_REQUEST['age'] . ',' . $_REQUEST['salary'] . ')';
            echo $query;
            mysqli_query($link, $query) or die(mysqli_error($link));
            echo 'Пользователь добавлен';
        }

        $query = "SELECT * FROM workers WHERE id > 0";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row)
            ;

        function funcTable($arr) {
            $tr = '';
            foreach ($arr as $str) {
                $td_name = '';
                $td = '';


                foreach ($str as $name => $value) {
                    $td_name .= '<th>' . $name . '</th>';
                    $td .= '<td>' . $value . '</td>';
                    $a = $td;
                }

                $tr .= '<tr>' . $a . '<td> <a href="index.php?del_id=' . $str[id] . '">удалить</a> </td></tr>';
                $b = $tr;
            }
            echo '<table border>' . $td_name . '<th>удаление</th>' . $b . '</table>';
        }

        funcTable($data);
        ?>

    </body>
    <form action="" method="GET">
        <input name="name" placeholder="Укажите имя новго работника"><br>
        <input name="age" placeholder="Укажите возраст новго работника"><br>
        <input name="salary" placeholder="Укажите зарплату новго работника"><br>
        <input type="submit" value="Send">    
    </form>
</html>

