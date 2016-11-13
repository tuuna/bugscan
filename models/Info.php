<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午9:43
 */
namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;
class Info extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%info}}";
    }


    public function rules()
    {
        return [
            ['info','safe','on' => Model::SCENARIO_DEFAULT],
            ['website','required','on' => Model::SCENARIO_DEFAULT],
            ['type','required','on' => Model::SCENARIO_DEFAULT]
        ];
    }
}