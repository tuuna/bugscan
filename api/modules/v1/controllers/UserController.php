<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-5
 * Time: 下午7:00
 */

namespace app\api\modules\v1\controllers;
use yii\rest\Controller;
use Yii;
use app\models\User;

class UserController extends Controller
{

    public function actionLogin()
    {
//        public $enableCsrfValidation = false;
        //新建用户
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->getRequest()->getBodyParams();
            $data['User']['username'] = $post['username'];
            $data['User']['password'] = $post['password'];
            if($id = $model->login($data)) {
                return json_encode(['status' => 1,'msg' => 'login successfully','uid' => $id,'code' => 200]);
            } else {
                return json_encode(['status' => 0,'msg' => '用户名或密码错误']);
            }
        } else {
            return ['status' => 0,'msg' => 'no post data recieved'];
        }

    }

    public function actionReg() {
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->getRequest()->getBodyParams();
            $data['User']['username'] = $post['username'];
            $data['User']['password'] = $post['password'];
            $data['User']['email'] = $post['email'];
            if($model->reg($data)) {
                return ['status' => 1,'msg' => '注册成功','code' => 200];
            } else {
                return json_encode(['status' => 0,'msg' => '注册失败']);
            }
        } else {
            return ['status' => 0,'msg' => 'no post data recieved'];
        }
    }


}