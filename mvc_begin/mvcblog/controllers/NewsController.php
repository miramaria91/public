
<?php

include_once ROOT . '/models/News.php';

class NewsController {

    public function actionIndex($page = 1) {
        $newsList = array();
        $newsList = News::getNewsList($page);
        $count = '';
        $count = News::getCountItems();

        require_once (ROOT . '/views/site/index.php');
        return true;
    }

    public function actionView($id) {
        if ($id) {
            $newsItem = News::getNewsItemById($id);
            require_once (ROOT . '/views/site/view.php');
            return true;
        }
    }

}
