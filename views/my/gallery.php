<?php
$this->registerCssFile('/web/slick/slick.css');
$this->registerCssFile('/web/slick/slick-theme.css');
$this->registerCssFile('/web/slick/slick-user.css');
if (isset($count)) {
    echo "<div class='container box'>Количество страниц: {$count}</div>";
} else {
   echo "<div class='container'>Вы можете загружать только файлы с расширением pdf.</div>";
}
?>
<section class="lazy slider" data-sizes="50vw">
    <?= $images ?>
</section>
<div class="container box">
    <a href="zip.php?name=" class="link">Скачать</a>
</div>
<?php
    $this->registerJsFile('/vendor/components/jquery/jquery.min.js');
    $this->registerJsFile('/web/slick/slick.js');
    $this->registerJsFile('/web/slick/slick-user.js');
?>
