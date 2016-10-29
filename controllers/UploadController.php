<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-29
 * Time: 下午12:03
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class UploadController extends Controller {
    public function actionIndex()
    {
        $this->layout = false;
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '_' . Yii::$app->session->get('username') . '.' .$model->file->extension);
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}