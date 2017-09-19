<?php include ROOT . '/views/layouts/header.php'; ?>
<?php foreach ($newsList as $newsItem) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class ="header_article">
                <a href="/mvcblog/news/<?php echo $newsItem['id']; ?>"><?php echo $newsItem['name']; ?></a>
            </div>
            <div class ="date"><?php echo $newsItem['date_create']; ?>
            </div>
            <div class ="text"><?php
                $text = $newsItem['text'];
                $text_prev = substr($text, 0, 1200) . '...';
                echo $text_prev;
                ?>
            </div><hr>
        </div>
    </div>
<?php endforeach; ?>
<?php
$count = $count['count'];
$pages = ceil($count / 4);
echo '<nav aria-label="Page navigation">'
 . '<ul class="pagination">'
 . '<li><a href="/mvcblog/pages/1">&lt</a></li>';
for ($i = 1; $i <= $pages; $i++) {
    echo '<li><a href="/mvcblog/pages/' . $i . '">' . $i . '</a></li>';
};
echo '<li><a href="/mvcblog/pages/' . $pages . '">&gt</a></li>' . '</ul></nav>';
?>
<?php include ROOT . '/views/layouts/footer.php'; ?>

