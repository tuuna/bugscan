<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午9:43
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;
class User extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%user}}";
    }


    public function rules()
    {
        return [
            ['username','required','message' => '用户名不能为空','on' => ['reg','login']],
//            ['username','required','message' => '用户名不能为空'],
            ['username','unique','message' => '用户名已被注册','on' => 'reg'],
            ['password','required','message' => '密码不能为空','on'=> ['reg','login']],
//            ['password','required','message' => '密码不能为空'],
            ['email','required','message' => '邮箱不能为空','on' => ['reg']],
//            ['email','required','message' => '邮箱不能为空'],
            ['email','email','message' => '邮箱格式不正确','on' => 'reg'],
            ['email','unique','message' => '邮箱已被注册','on' => 'reg'],
            ['password','validatePass','on' => ['login']],
//            ['create_at','addTime','on' => Model::SCENARIO_DEFAULT]
        ];
    }


    public function validatePass()
    {

        $data = self::find()->where('username'.' = :username and password = :pass', [':username' => $this->username, ':pass' => md5($this->password)])->one();
        if (is_null($data)) {
            $this->addError("password", "用户名或者密码错误");
        }
    }
    public function reg($data, $scenario = 'reg')
    {
        $this->scenario = $scenario;
        if ($this->load($data) && $this->validate()) {
            $this->create_at = time();
            $this->password = md5($this->password);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function login($data)
    {
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
            $lifetime = 24*3600;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['uid'] = $this->find()->where('username = :username',[':username' => $this->username])->one()->id;
            $session['username'] = $this->username;
            $session['isLogin'] = 1;
            return $session['uid'];
        }
        return false;
    }

}