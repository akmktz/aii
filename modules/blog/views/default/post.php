<?php
/* @var $this yii\web\View */
$this->title = $post->name;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['group', 'groupAlias' => $group->alias]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="site-index">
    <h1><?= $this->title; ?> </h1>
    <p><?= nl2br($post->text); ?> </p>
    <p><small><?= nl2br($post->date); ?> </small></p>
    Комментарии:
    <ul>
        <?php foreach($result as $obj): ?>
            <li>
                <b><?= $obj->name ?></b> (<?= $obj->date ?>): <?= $obj->text ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>