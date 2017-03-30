<?php

namespace app\modules\content\controllers;

use Yii;
use app\CMS\CController;
use app\modules\content\models\ContactForm;
use app\modules\content\models\Pages;

/**
 * Default controller for the `content` module
 */
class DefaultController extends CController
{
    private $_page;

    public function beforeAction($action)
    {
        $this->_page = Pages::find()->where('status = 1')->where(['alias' => $action->id])->one();
        if (!$this->_page) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionAbout()
    {
        return $this->render($this->action->id, ['page' => $this->_page]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        $model->name = 'test user';
        $model->email = 'test@mail.ml';
        $model->text = 'TEST TEST TEST';
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render($this->action->id, ['model' => $model, 'page' => $this->_page]);
    }
}
