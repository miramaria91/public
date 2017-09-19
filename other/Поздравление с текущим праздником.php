<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Name</title>
    </head>
    <body>
        <?php
        $celebrations = array('8 марта' => '08.03', '23 февраля' => '23.02', 'День святого валентина' => '14.02');
        $today = date('d.m', time());
        $flag = 0;

        foreach ($celebrations as $moment => $data) {
            if ($today == $data) {
                $flag = 1;
                echo 'Поздравляем, сегодня ' . $moment;
                break;
            }
        }
        if ($flag == 0) {
            echo 'Сегодня не праздничный день';
        }
        ?>       
    </body>
</html>

