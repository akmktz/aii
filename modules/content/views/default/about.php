<?php
/* @var $this yii\web\View */
$this->title = $page->h1 ?: $page->name;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<p><?= \yii\helpers\HtmlPurifier::process($page->text); ?> </p>
