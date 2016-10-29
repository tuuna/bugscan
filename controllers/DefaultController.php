<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午11:17
 */

namespace app\controllers;
use yii\web\Controller;

class DefaultController extends Controller {
    public function actionIndex() {
        return $this->renderPartial('index');
    }
}