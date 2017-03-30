<?php
/* @var $this yii\web\View */
$this->title = 'Категории';
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<ul class="cols">
    <?php foreach($result as $obj): ?>
        <div class="col3 left">
            <h2 class="label label-green">
                <?= \yii\helpers\Html::a($obj->name, ['group', 'groupAlias' => $obj->alias]); ?>
            </h2>
            <p class="quiet large"><?= \yii\helpers\StringHelper::truncate(
                        \yii\helpers\HtmlPurifier::process($obj->text, ['HTML.Allowed' => '']), 300, '...') ?></p>

            <p>
                <?= \yii\helpers\Html::a('Подробнее &raquo;', ['group', 'groupAlias' => $obj->alias], ['class' => "more"]); ?>
            </p>
        </div>
    <?php endforeach; ?>
    <div class="clearer">&nbsp;</div>
</ul>