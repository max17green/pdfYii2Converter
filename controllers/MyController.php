<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FileClass;
use yii\web\UploadedFile;

class MyController extends Controller
{
    private $countPages;
    private $model;
    public function actionIndex()
    {
        $this->model = new FileClass();


        //echo $this->countPages;
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
        //$this->model = new FileClass();
        var_dump($this -> model);
        $this->model -> initFile();
        $this->countPages = $this->model->getCountPages($this->model->pdf->tempName);
        //print_r($model);
        //$count = $model -> getCountPages($model->pdf->tempName);
        //echo $count;
        return $this->render('gallery');
    }
}
