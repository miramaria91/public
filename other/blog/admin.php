<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Панель администратора</title>  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/head.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts.css" />
  </head>
  <body>
      <?php if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
            
        
        $host = '127.0.0.1';
        $user = 'root';
        $pass = '42244224';
        $db_name = 'blog';
        $link = mysqli_connect($host, $user, $pass, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");        
        ?>
      <div class="container">
                <!--menu-->
          <div class="row">
      <nav class="navbar navbar-default">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Панель администратора</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="logout.php">Выйти</a></li>  
                  </ul>
              </div>
            </nav>
          </div>
            
                
                 <!--Таблица-->               
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading">Мои статьи</div>
  
                 <?php
 
            
            // формируем массив со статьями из базы
            $query = 'SELECT * FROM articles';
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
            
            echo '<table class="table"><col width=10%><col width=40%><col width=25%>';
            foreach ($data as $key){
             $text = $key['text'];
            $text_prev = substr($text, 0, 400).'...';
           echo '<tr>
          <td>'.$key['name'].'</td>
          <td>'.$text_prev.'</td>
          <td>'.$key['date_create'].'</td>
          <td><a href="admin.php?delete_id='.$key['id'].'">Удалить статью</td>
          <td><a href="admin.php?create_id='.$key['id'].'">Редактировать статью</td>
          <td><a href="admin.php?view_id='.$key['id'].'">Просмотр статьи</td>
           </tr>';
            }
            echo '</table>';     
            ?> 

</div>
<div><a class="btn btn-default button" href="admin.php?val_but" role="button">Создать новую статью</a></div>
</div>
     <?php
     if(isset($_REQUEST['val_but'])){
     ?>       
                 <!--Кнопка добавления новой статьи-->
                 <div class="row">
                     <div class="newarticle">
                     <p>Cоздание новой статьи</p>
                     <form action="admin.php" method="POST">
                         <input type="text" name="name_create" class="form-control" placeholder="Название новой статьи"><br>
                         <textarea name="text_create" class="form-control" rows="6"></textarea><br>
                         <input class="btn btn-default" type="submit" value="Cоздать">
                     </form>
                     </div>         
                 </div>
     <?php }
     if(!empty($_REQUEST['text_create']) and !empty($_REQUEST['name_create'])){
          $name = $_REQUEST['name_create'];
          $text = $_REQUEST['text_create'];
          $date = date('Y-m-d',time());
          $query = "INSERT INTO articles (name,text,date_create) VALUES ('".$name."','".$text."','".$date."')";
          mysqli_query($link, $query) or die(mysqli_error($link));
          header('location:admin.php');
     }
     
   ?>   
 <?php
 // Если нажали удалить статью
 if(!empty($_REQUEST['delete_id'])){
 $id = $_REQUEST['delete_id'];
 $query = 'DELETE FROM articles WHERE id='.$id;
 mysqli_query($link, $query) or die(mysqli_error($link));
 header('location:admin.php');
 }
 ?>
 <?php
 // Если нажали редактировать статью
 if(!empty($_REQUEST['create_id'])){
   $create_id = $_REQUEST['create_id'];
   $query = 'SELECT * FROM articles WHERE id='.$create_id;
   $result = mysqli_query($link, $query) or die(mysqli_error($link));
   $article = mysqli_fetch_array($result);
   $name = $article['name'];
   $text = $article['text'];    
     ?> 
                 <div class="row">                     
                     <div class="newarticle">
                     <p>Редактирование статьи</p>
                     <form action="admin.php" method="POST">
                         <input name="name_edit" type="text" class="form-control" value="<?php echo $name;?>"><br>
                         <textarea name="text_edit" class="form-control" rows="10"><?php echo $text; ?></textarea><br>
                         <input name="id" type="hidden" class="form-control" value="<?php echo $create_id; ?>">
                         <input class="btn btn-default" type="submit" value="Cохранить">
                     </form>
                     </div>         
                 </div>
 <?php  }
 if(!empty($_REQUEST['name_edit']) and !empty($_REQUEST['text_edit'])){
     $name = $_REQUEST['name_edit'];
     $text = $_REQUEST['text_edit'];
     $date = date('Y-m-d',time());
     $id = $_REQUEST['id'];
    $query = "UPDATE articles SET name='".$name."', text='".$text."', date_create='".$date."' WHERE id='".$id."'";
    echo $query;
    mysqli_query($link, $query) or die(mysqli_error($link));
    header('location:admin.php');
 }
 ?>
 
 <?php
 //Если нажали на просмотр статьи
 if(!empty($_REQUEST['view_id'])){
                   
         $query = 'SELECT * FROM articles WHERE id="'.$_REQUEST['view_id'].'"'; 
         $result = mysqli_query($link, $query) or die(mysqli_error($link));
         $article = mysqli_fetch_array($result);
     ?>    
            <div class="row">               
                    <div class="header_article"><?php echo $article['name'];?></div>
                    <div class="date_create"><?php echo $article['date_create']?></div>
                    <div class="text"><?php echo $article['text']?></div>
                    <div><a class="btn btn-default button" href="admin.php" role="button">Cвернуть</a></div>               
            </div>
            
      <?php } 
      
       }else{?>
                 <div class="row">
                     <div class="col-lg-12">
                 <div class="alert alert-danger" role="alert">Нет доступа<br></div>
                 <div class="btn-group" role="group" aria-label="...">
                     <button type="button" class="btn btn-default"><a href="auth.php">Авторизация</a></button>
                     <button type="button" class="btn btn-default"><a href="index.php">На главную</a></button>
                 </div>
                 </div>
                 </div>
                    
     <?php }?>
                 
          
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>