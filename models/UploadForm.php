<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-29
 * Time: 下午12:07
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file','extensions' => 'zip,gz,tar.gz,rar','maxSize' => 1024*32],
        ];
    }
}