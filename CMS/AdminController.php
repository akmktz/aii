<?php

namespace app\CMS;

use yii\web\Controller;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            if ($action->id != 'login' || $action->controller->id != 'default' || $action->controller->module->id != 'admin') {
                return $this->redirect(['/admin/login']);
                die;
            }
        }

        $this->layout = '/admin/main';

        return parent::beforeAction($action);
    }

}
