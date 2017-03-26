<?php
/* @var $this yii\web\View */
$this->title = 'Категории';
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="site-index">
    <h1><?= $this->title; ?> </h1>

    <ul>
        <?php foreach($result as $obj): ?>
            <li>
                <?= \yii\helpers\Html::a($obj->name, ['group', 'groupAlias' => $obj->alias]); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>