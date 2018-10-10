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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="bg"></div>
<main>

    <?php echo $content ?>
</main>
<?php $this->endBody(); ?>
</body>
</html>
<?php
    if (Yii::$app->controller->action->id == 'gallery') {
        file_put_contents($this->params['nameDir'].'/index.html', ob_get_contents());
    }
?>
<?php $this->endPage() ?>