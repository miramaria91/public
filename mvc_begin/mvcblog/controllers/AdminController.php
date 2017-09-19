<?php

class AdminController {

    public function actionIndex() {
        require_once (ROOT . '/views/site/admin.php');
        return true;
    }

}
