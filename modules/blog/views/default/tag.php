<?php
/* @var $this yii\web\View */
$this->title = 'Поиск по тегам: ' . $tag;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<ul>
    <?php foreach($result as $obj): ?>
        <div class="post">
            <div class="archive-post-date">
                <div class="archive-post-day"><?= date('d', strtotime($obj->date)) ?></div>
                <div class="archive-post-month"><?= date('m.y', strtotime($obj->date)) ?></div>
            </div>
            <div class="archive-post-title">
                <h3>
                    <?= \yii\helpers\Html::a($obj->name . ' (' . $obj->date . ')',
                        ['post', 'groupAlias' => $obj->category->alias, 'postAlias' => $obj->alias]); ?>
                </h3>
                <div class="post-date"><?= \yii\helpers\StringHelper::truncate($obj->text ,150 ,'...') ?></div>
            </div>
            <div class="clearer">&nbsp;</div>
        </div>
    <?php endforeach; ?>
</ul>