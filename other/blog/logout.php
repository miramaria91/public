<?php
echo $_SESSION['auth'];
	//Если переменная auth из сессии не пуста и равна true, то...
	if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
		session_start();
                session_destroy();} //разрушаем сессию для пользователя
                header('location: index.php');
        ?>