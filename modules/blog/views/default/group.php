<?php
/* @var $this yii\web\View */
$this->title = $group->name;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="site-index">
    <h1><?= $this->title; ?> </h1>
    <p><?= $group->text; ?> </p>
    <ul>
        <?php foreach($result as $obj): ?>
            <li>
                <?= \yii\helpers\Html::a($obj->name . ' (' . $obj->date . ')',
                    ['post', 'groupAlias' => $group->alias, 'postAlias' => $obj->alias]); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>