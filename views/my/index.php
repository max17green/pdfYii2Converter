<!--<form action="treatment/index.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="52428800" />
        <input type="file" name="userfile">-->

<h1>Russian pdf reader</h1>
<h2>Выберите pdf файл для конвертации</h2>
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'action'  => ['my/gallery']
    ]);
echo $form->field($model, 'pdf')->fileInput()->label('Файл');

//echo $form->field($model, 'par1');
echo Html::submitButton('Отправить файл', ['class' => 'btn btn-success in']);
ActiveForm::end();
?>




