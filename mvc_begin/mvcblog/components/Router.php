<?php

// В данном файле содержится роутер, который анализирует запрос, определяет контроллер, и передает ему управление

class Router {

    // массив, в котором будут хранится маршруты (пути к экшенам/методам контроллера)
    private $routes;

    // c помощью конструктора мы прочитаем и запомним роуты
    public function __construct() {

        // указываем путь к роутам
        $routesPath = ROOT . '/config/routes.php';

        //в свойство routes присваем массив из файла routes.php
        $this->routes = include($routesPath);
    }

    //приватный метод для получения строки запроса
    private function getURI() {
        //если строка запроса существует, обрежем из нее слеши и вернем результат
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    //метод, который принимает управление от front controller
    //отвечает за анализ запроса и передачу управления
    public function run() {

        // ПОЛУЧАЕМ СТРОКУ ЗАПРОСА
        // обращаемся к методу получения строки запроса и записываем значение в переменную $uri
        $uri = $this->getURI();
        $uri = substr($uri, 8);


        // ПРОВЕРКА НАЛИЧИЯ ЗАПРОСА В МАРШРУТАХ route.php
        // перебираем массив роутов
        foreach ($this->routes as $uriPattern => $path) {
            //сравниваем $uriPattern и $uri
            if (preg_match("#$uriPattern#", $uri)) {

                // ПОЛУЧАЕМ ВНУТРЕННИЙ ПУТЬ ИЗ ВНЕШНЕГО СОГЛАСНО ПРАВИЛУ
                $internalRoute = preg_replace("#$uriPattern#", $path, $uri);



                // ОПРЕДЕЛИМ КОНТРОЛЛЕР И ЭКШН (КЛАСС И МЕТОД) ДЛЯ ОБРАБОТКИ ЗАПРОСА
                $segment = explode('/', $internalRoute); //получим массив, где 0=>контроллер, 1=>экшн
                // ИМЯ КОНТРОЛЛЕРА (имя класса контроллера)

                $controllerName = array_shift($segment) . 'Controller';
                $controllerName = ucfirst($controllerName);


                // ИМЯ ЭКШЕНА
                $actionName = 'action' . ucfirst(array_shift($segment));


                // ОПРЕДЕЯЕМ ПАРАМЕТРЫ (массив с параметрами)
                // функция array_shift вырезала из массива название контроллера и метода и остались только параметры
                $parameters = $segment;


                // ПОДКЛЮЧАЕМ ФАЙЛ КОНТРОЛЛЕРА
                //определяем файл, который нужно подключить
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                //проверяем существование такого файла и подключаем его
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // СОЗДАЕМ ОБЬЕКТ КОНТРОЛЛЕРА
                $controllerObject = new $controllerName;

                // ВЫЗЫВАЕМ МЕТОД КОНТРОЛЛЕРА
                // данная функция вызывает экшн у контроллера, передавая ему массив с параметрами
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                // если данный метод срабатывает и возращает результат, обрываем цикл подбора метода
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
