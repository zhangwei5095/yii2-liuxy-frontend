<?php

namespace liuxy\frontend\components;

use liuxy\frontend\assets\ThemeAsset;
use liuxy\frontend\Theme;
use Yii;
use yii\liuxy\WebController;

/**
 * Main backend controller.
 */
abstract class Controller extends WebController {
    /**
     * 返回内部错误信息
     * @param array $errors 错误队列
     * @param int $code 错误码
     */
    protected function setError($errors = [], $code = 500) {
        $this->setResponseData(['code'=>$code]);
        $errorMesage = '';
        if ($errors) {
            if (is_array($errors)) {
                foreach ($errors as $key=>$value) {
                    $errorMesage.=$key.':';
                    if (is_array($value)) {
                        foreach ($value as $err) {
                            $errorMesage.=$err.'<br/>';
                        }
                    } else {
                        $errorMesage.=$value.'<br/>';
                    }
                }
            } else {
                $errorMesage = $errors;
            }
        }
        $this->setResponseData(['msg'=>$errorMesage]);
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        $this->setResponseData('themeUrl',  Yii::getAlias('@web').'/themes/'.Yii::$app->view->theme->template);
    }

    public function end() {
        parent::end();

        Yii::$app->session->close();
    }


}
