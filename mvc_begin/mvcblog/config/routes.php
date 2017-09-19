<?php

return array(
    'index.php' => 'news/index',
    'news/([0-9]+)' => 'news/view/$1/',
    'pages/([0-9]+)' => 'news/index/$1',
    'auth' => 'user/register',
    'admin' => 'admin/index'
);

