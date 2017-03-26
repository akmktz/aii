<?php

namespace app\modules\blog\controllers;

use app\modules\blog\models\Categories;
use app\modules\blog\models\Comments;
use app\modules\blog\models\Posts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `modulesblog` module
 */
class DefaultController extends Controller
{

    public function beforeAction($action)
    {
        //$this->homeLink = '/admin/';

        $result = parent::beforeAction($action);
        return $result;
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $result = Categories::find()->where('status = 1')->orderBy('name')->all();
        return $this->render('index', compact('result'));
    }

    /**
     * Renders the group view for the module
     * @param string $groupAlias
     * @throws NotFoundHttpException if the model cannot be found
     * @return string
     */
    public function actionGroup($groupAlias)
    {
        $group = Categories::find()
            ->where(['alias' => $groupAlias])
            ->andWhere('status = 1')
            ->one();
        if (!$group) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        $result = Posts::find()
            ->where(['category_id' => $group->id])
            ->andWhere('status = 1')
            ->orderBy('date DESC')
            ->all();
        return $this->render('group', compact('group', 'result'));
    }

    /**
     * Renders the group view for the module
     * @param string $groupAlias
     * @param string $postAlias
     * @throws NotFoundHttpException if the model cannot be found
     * @return string
     */
    public function actionPost($groupAlias, $postAlias)
    {
        $group = Categories::find()
            ->where(['alias' => $groupAlias])
            ->andWhere('status = 1')
            ->one();
        if (!$group) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        $post = Posts::find()
            ->where(['alias' => $postAlias])
            ->andWhere('status = 1')
            ->one();
        if (!$post) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        $result = Comments::find()
            ->where(['post_id' => $post->id])
            ->andWhere('status = 1')
            ->orderBy('date DESC')
            ->all();
        return $this->render('post', compact('group', 'post', 'result'));
    }
}
