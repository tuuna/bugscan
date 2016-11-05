<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午9:02
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use Yii;

class RegController extends Controller {
    public function actionLogin() {
        $this->layout = 'log_reg';
        $model = new User;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->login($post)) {
                $this->redirect(['default/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login',['model' => $model]);
    }

    public function actionReg() {
        $this->layout = 'log_reg';
        $model = new User;
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '注册成功');
                $this->redirect(['reg/login']);
            }
        }
        return $this->render('reg',['model' => $model]);
    }
}