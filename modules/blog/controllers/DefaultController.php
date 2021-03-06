<?php

namespace app\modules\blog\controllers;

use app\CMS\CController;
use app\modules\blog\models\Categories;
use app\modules\blog\models\Comments;
use app\modules\blog\models\Posts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `modulesblog` module
 */
class DefaultController extends CController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $result = Categories::find()->where('status = 1')->andWhere('date <= now()')->orderBy('name')->all();
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
            ->andWhere('date <= now()')
            ->andWhere('status = 1')
            ->one();
        if (!$group) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        $result = Posts::find()
            ->where(['category_id' => $group->id])
            ->andWhere('date <= now()')
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
            ->andWhere('date <= now()')
            ->andWhere('status = 1')
            ->one();
        if (!$group) {
            throw new NotFoundHttpException('Ничего не найдено.');
        }

        $post = Posts::find()
            ->where(['alias' => $postAlias])
            ->andWhere('date <= now()')
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

        $model = new Comments();
        $postResult = $model->load(\Yii::$app->request->post());
        $model->post_id = $post->id;
        $model->date = date('d.m.Y');
        $model->status = 0;
        if ($postResult && $model->save()) {
            \Yii::$app->session->addFlash('info', 'Отзыв добавлен. Он будет показан когда его проверит администратор.');

            return $this->redirect(['post', 'groupAlias' => $group->alias, 'postAlias' => $post->alias]);
        } else {
            return $this->render('post', compact('group', 'post', 'result', 'model'));
        };
    }

    /**
     * Renders the group view for the module
     * @param string $groupAlias
     * @throws NotFoundHttpException if the model cannot be found
     * @return string
     */
    public function actionTag($tag = null)
    {
        $result = [];
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        if ($tag ||
                (isset(\Yii::$app->request->post()['tag'])
                    && ($tag = preg_replace('/[^\w\s]/u', '', \Yii::$app->request->post()['tag'])) )
           )
        {
            $result = Posts::find()
                ->where('status = 1')
                ->with('category')
                ->andWhere('date <= now()')
                ->andWhere('MATCH(tags) AGAINST (:tag) > 0', ['tag' => $tag])
                ->all();
        }

        return $this->render('tag', compact('tag', 'result'));
    }
}
