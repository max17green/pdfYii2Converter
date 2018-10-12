<?php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (Yii::$app->controller->action->id == 'gallery') {
        ?>
            <link rel="stylesheet" href="slick/slick.css">
            <link rel="stylesheet" href="slick/slick-theme.css">
            <link rel="stylesheet" href="slick/slick-user.css">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/main.css">
        <?php
    }
            $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="bg"></div>
<main>

    <?php echo $content ?>
</main>
<?php
$this->endBody();
if (Yii::$app->controller->action->id == 'gallery') {
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="slick/slick.js"></script>
    <script src="slick/slick-user.js"></script>
    <?php
}
?>
</body>
</html>
<?php
if (Yii::$app->controller->action->id == 'gallery') {
    file_put_contents($this->params['nameDir'].'/index.html', ob_get_contents());
}
?>
<?php $this->endPage() ?>
