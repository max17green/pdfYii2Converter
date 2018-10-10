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
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionGallery()
    {
        $model = new FileClass();
        if (Yii::$app->request->isPost) {
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            if ($model->pdf->getExtension() == 'pdf') {
                $model->initFile();
                $model->getWidthHeight($model->pdf->tempName);
                $model->generateImages($model->pdf->tempName);
            }
            return $this->render('gallery', array(
                'count' => $model->getCountPages($model->pdf->tempName),
                    'images' => $model->printImages()
                ));
                //['count' => $model->getCountPages($model->pdf->tempName)]//,
                //['images' => $model->printImages()]

        }//if ($model->pdf && $model->validate())
    }
}