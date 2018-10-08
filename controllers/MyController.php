<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FileClass;
use yii\web\UploadedFile;

class MyController extends Controller
{
    private $countPages;
    public $model;
    public function actionIndex()
    {
        $this->model = new FileClass();
        //FileClass::inite();
        //var_dump($this -> model);
        //$countPages = $this->model->getCountPages($this->model->pdf->tempName);
        /*if (Yii::$app->request->isPost) {
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            if ($model->pdf && $model->validate()) {
                //$model->pdf->saveAs(Yii::getAlias('@webroot/').$model->pdf->name);
                return $model->getCountPages($model->pdf->tempName);//$model->getCountPages(
            }
        }*/
        return $this->render('index', [
            'model' => $this->model,
        ]);
    }
    public function actionGallery() {
        //var_dump($this -> model);
        //$this -> model -> getCountPages($this -> model->pdf->tempName);
        return $this->render('gallery');
    }
}
