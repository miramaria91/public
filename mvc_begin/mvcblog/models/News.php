<?php

class News {

    public static function getNewsList($page = 1) {

        $db = Db::getConnection();

        $newsList = array();
        $offset = ($page - 1) * 4;
        $result = $db->query('SELECT * FROM articles ORDER BY id LIMIT 4 OFFSET ' . $offset);
        $i = 0;

        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['name'] = $row['name'];
            $newsList[$i]['text'] = $row['text'];
            $newsList[$i]['date_create'] = $row['date_create'];
            $i++;
        }
        return $newsList;
    }

    public static function getNewsItemById($id) {

        $id = intval($id);


        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM articles WHERE id=' . $id);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $newsItem = $result->fetch();
        return $newsItem;
    }

    public static function getCountItems() {


        $db = Db::getConnection();
        $result = $db->query('SELECT COUNT(*) as count FROM articles WHERE id > 0');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $count = $result->fetch();
        return $count;
    }

}
