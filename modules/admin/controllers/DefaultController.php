<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\LoginForm;
use app\CMS\AdminController;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/admin/login']);
    }

    public function actionSetStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Check user login
        if (Yii::$app->user->isGuest) {
            return ['success' => false];
        }

        // Get data
        $table = Yii::$app->request->post('table');
        $id = Yii::$app->request->post('id');
        $status = Yii::$app->request->post('status');

        // Change status
        Yii::$app->db->createCommand()->update($table, compact('status'), 'id=:id', compact('id'))->execute();

        return ['success' => true];
    }
}
