<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии к постам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index js-status-config"
     data-table-name="<?= $searchModel::tableName(); ?>"
     data-class-on="glyphicon-ok-circle text-success" data-class-off="glyphicon-ban-circle text-warning" >

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'filter' => true,
                'attribute' => 'postName',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->postName, ['admin/posts/update', 'id' => $data->post_id]);
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($data) {
                    return Html::a(
                        \yii\helpers\StringHelper::truncate(strip_tags($data->name), 30, '...'),
                        ['update', 'id' => $data->id]
                    );
                }
            ],
            'email:email',
            [
                'attribute' => 'text',
                'enableSorting' => false,
                'format' => 'html',
                'value' => function($data) {
                    return Html::a(
                        \yii\helpers\StringHelper::truncate(strip_tags($data->text), 47, '...'),
                        ['update', 'id' => $data->id]
                    );
                }
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'status',
                'filter' => [1 => 'Да', 0 => 'Нет'],
                'options' => ['style' => 'width: 65px; max-width: 65px;'],
                'contentOptions' => ['align' => 'center', 'class' => 'a-buttons-container'],
                'format' => 'raw',
                'value' => function($data) {
                    return
                        Html::a(
                            Html::tag('span', null, ['class' => 'glyphicon glyphicon-' .
                                ($data->status ? 'ok-circle text-success' : 'ban-circle text-warning')]),
                            '#',
                            ['class' => 'js-status-switch', 'data-id' => $data->id, 'data-status' => $data->status]
                        ) . Html::a(
                            Html::tag('span', null, ['class' => 'glyphicon glyphicon-pencil']),
                            ['update', 'id' => $data->id],
                            ['class' => 'text-info']
                        ) . Html::a(
                            Html::tag('span', null, ['class' => 'glyphicon glyphicon-trash']),
                            ['delete', 'id' => $data->id],
                            [
                                'class' => 'text-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                }
            ],

        ],
    ]); ?>
</div>
