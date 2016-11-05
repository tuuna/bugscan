<?php

namespace app\api\modules\v1;

use \yii\base\Module;

/**
 * api module definition class
 */
class Api extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
