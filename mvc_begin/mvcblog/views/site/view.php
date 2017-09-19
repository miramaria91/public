<?php include ROOT . '/views/layouts/header.php'; ?>              
<div class="row">
    <div class="col-lg-12">
        <div class="header_article"><?php echo $newsItem['name']; ?></div>
        <div class="date_create"><?php echo $newsItem['date_create']; ?></div>
        <div class="text">s<?php echo $newsItem['text']; ?></div>
        <div><a class="btn btn-default button" href="mvcblog/../../index.php" role="button">Назад</a></div>

    </div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>
