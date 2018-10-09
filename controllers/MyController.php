<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FileClass;
use yii\web\UploadedFile;

class MyController extends Controller
{
    public function actionIndex()
    {
        $model = new FileClass();
        //$model->pdf->saveAs(Yii::getAlias('@webroot/').$model->pdf->name);
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    public function actionGallery() {
        //$this->model -> initFile();
        $model = new FileClass();
        //$model->load(Yii::$app->getRequest()->post());
        if (Yii::$app->request->isPost) {
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            //if ($model->pdf && $model->validate()) {
                //$model->pdf->baseName;
            //}
        }
        return $this->render('gallery',
            //['model' => $model->printM()],
            ['count' => $model->getCountPages($model->pdf->tempName)]
        );
    }
}
