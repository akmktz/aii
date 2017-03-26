<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Comments */

$this->title = 'Изменение комментария: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии к постам', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Изменение: ' . $model->name];
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
