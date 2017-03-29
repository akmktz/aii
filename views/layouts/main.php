<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->beginPage()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!--<link rel="stylesheet" type="text/css" href="style.css" media="screen" />-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="site-wrapper">
    <div id="header">
        <div id="top">
            <div class="left" id="logo">
                <?php if ($_SERVER['REQUEST_URI'] != '/'): ?>
                    <a href="/"><img src="/img/logo.gif" alt="" /></a>
                <?php else: ?>
                    <span><img src="/img/logo.gif" alt="" /></span>
                <?php endif; ?>
            </div>
            <div class="left navigation" id="main-nav">
                <?php if (isset($this->context->_menu) && count($this->context->_menu)): ?>
                    <ul class="tabbed">
                        <?php foreach($this->context->_menu as $obj): ?>
                            <li class="<?= $obj['active'] ? 'current-tab' : '' ?>">
                                <?= Html::a($obj['label'], $obj['active'] ? null : $obj['url']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="clearer">&nbsp;</div>
            </div>
            <div class="clearer">&nbsp;</div>
        </div>
        <?php if (isset($this->context->_subMenu) && count($this->context->_subMenu)): ?>
            <div class="navigation" id="sub-nav">
                <ul class="tabbed">
                    <?php foreach($this->context->_subMenu as $obj): ?>
                        <li class="<?= $obj['active'] ? 'current-tab' : '' ?>">
                            <?= Html::a($obj['label'], $obj['active'] ? null : $obj['url']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="clearer">&nbsp;</div>
            </div>
        <?php endif; ?>
    </div>
    <div class="main" id="main-two-columns">
        <div class="left" id="main-content">
            <h1><?= $this->title; ?> </h1>
            <div class="archive-pagination archive-pagination-top">
                <?= Breadcrumbs::widget([
                    'homeLink' => isset($this->params['homeLink']) ? $this->params['homeLink'] : null,
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'class' => 'tabbed'
                ]) ?>
                <div class="clearer">&nbsp;</div>
            </div>
            <?= $content ?>
        </div>
        <div class="right sidebar" id="sidebar">
            <div class="section">
                <div class="section-title">Поиск по тегам</div>
                <div class="section-content">
                    <?php $form = \yii\widgets\ActiveForm::begin(['action' => '/tag']); ?>
                        <?= \yii\helpers\Html::textInput('tag',
                            isset(\Yii::$app->request->post()['tag']) ? \Yii::$app->request->post()['tag'] : '',
                            ['maxlength' => 255, 'class' => 'text', 'size' => 28]); ?>
                        &nbsp
                        <?= \yii\helpers\Html::submitInput('Найти', ['class' => 'button']) ?>
                    <?php \yii\widgets\ActiveForm::end(); ?>
                </div>
            </div>
            <?php if (isset($this->context->_mainPosts) && count($this->context->_mainPosts)): ?>
                <div class="section">
                    <div class="section-title">Выборочные посты</div>
                    <div class="section-content">
                        <ul class="nice-list">
                            <?php foreach($this->context->_mainPosts as $obj): ?>
                            <?php if ($obj['active']) continue; ?>
                                <li>
                                    <div class="left"><?= Html::a($obj['label'], $obj['url']) ?></div>
                                    <div class="right"><?= date('d.m.y', strtotime($obj['date'])) ?></div>
                                    <div class="clearer">&nbsp;</div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($this->context->_mainComments) && count($this->context->_mainComments)): ?>
                <div class="section">
                    <div class="section-title">Выборочные комментарии</div>
                    <div class="section-content">
                        <ul class="nice-list">
                            <?php foreach($this->context->_mainComments as $obj): ?>
                                <?php if ($obj['active']) continue; ?>
                                <li>
                                    <span><?= $obj['name'] ?></span>
                                    <span class="quiet">- <?= Html::a($obj['text'], $obj['url']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($this->context->_mainTags) && count($this->context->_mainTags)): ?>
                <div class="section">
                    <div class="section-title">Выборочные теги</div>
                    <div class="section-content">
                        <div class="quiet">
                            <?php foreach($this->context->_mainTags as $tag): ?>
                                <a href="/tag/<?= $tag ?>" style="font-size: <?= rand(100, 200) ?>%"><?= $tag ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div id="footer">
        <div class="left" id="footer-left">
            <img src="/img/logo-small.gif" alt="" class="left" />
            <p>&copy; 2002-2009 Simple Organization. All rights Reserved</p>
            <p class="quiet"><a href="http://templates.arcsin.se/">Website template</a> by <a href="http://arcsin.se/">Arcsin</a></p>
            <div class="clearer">&nbsp;</div>
        </div>
        <div class="right" id="footer-right">
            <?php if (isset($this->context->_subMenu) && count($this->context->_subMenu)): ?>
                <p class="large">
                    <?php foreach($this->context->_subMenu as $obj): ?>
                        <?php if ($obj['active']): ?>
                            <strong>
                        <?php endif; ?>
                                <?= Html::a($obj['label'], $obj['active'] ? null : $obj['url']) ?>
                        <?php if ($obj['active']): ?>
                            </strong>
                        <?php endif; ?>
                            <span class="text-separator">|</span>
                    <?php endforeach; ?>
                    <a href="#top" class="quiet">Page Top &uarr;</a>
                </p>
            <?php endif; ?>
            <p><?= Yii::powered() ?></p>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>