<?php

namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
//use yii\web\Response;

class ImageUploadController extends Controller
{
    public function actionIndex()
    {
//        echo 'hello from image upload controller';
        return $this->render('image');
    }
}

