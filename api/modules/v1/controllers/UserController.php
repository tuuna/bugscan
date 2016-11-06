<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-5
 * Time: 下午7:00
 */

namespace app\api\modules\v1\controllers;
use yii\rest\ActiveController;
//use Yii;
//use app\models\User;

class UserController extends ActiveController
{

    public $modelClass = 'app\models\User';
/*
    public function actions()
    {
        $actions = parent::actions();

        // 注销系统自带的实现方法
        unset($actions['create']);

        //unset($actions['create']);
        //unset($actions['update']);
        //unset($actions['delete']);

        return $actions;
    }

//覆盖父类的actionIndex方法,并进行重写
    public function actionCreate()
    {
        //新建用户
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->getRequest()->getBodyParams();
            if($model->reg($post)) {
                return json_encode(['status' => 1,'msg' => 'add success','username' => $post['username']]);
            } else {
                return json_encode(['status' => 0,'msg' => 'add fail']);
            }
        } else {
            return ['status' => 0,'msg' => 'no post data recieved'];
        }

    }*/

}