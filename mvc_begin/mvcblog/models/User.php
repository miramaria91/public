<?php

class User {

    public static function checkUser($login, $password) {

        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM user WHERE login="' . $login . '"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $user = $result->fetch();
        return $user;
    }

}
