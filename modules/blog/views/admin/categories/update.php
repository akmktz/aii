<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Categories */

$this->title = 'Категория: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
