<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FileClass;
use app\models\ZipClass;
use app\models\RestApiClass;
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
                $this->view->params['nameDir'] = $model->getNameDir();
            }
            return $this->render('gallery', array(
                'count' => $model->getCountPages($model->pdf->tempName),
                'images' => $model->printImages()
                ));
        }//if ($model->pdf && $model->validate())
    }
    public function actionZip() {
        $model = new ZipClass();
        $model->setAttributes(Yii::$app->request->get());
        if ($model->validate()) {
            if ($model->initZip()) {
                if ($model->create()) {
                    $model->addIn();
                    $model->output();
                }
            }
        }
    }
    public function actionRest() {
        $this->layout = '@app/views/layouts/rest.php';
        $model = new RestApiClass();
        $model->setAttributes(Yii::$app->request->get());
        $model->validate();
        return $this->render('rest',
            ['rest' => $model->getRestApi()]
        );
    }
}