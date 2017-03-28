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
                <a href="/"><img src="/img/logo.gif" alt="" /></a>
            </div>
            <div class="left navigation" id="main-nav">
                <?php if (isset($this->context->_menu) && count($this->context->_menu)): ?>
                    <ul class="tabbed">
                        <?php foreach($this->context->_menu as $obj): ?>
                            <li class="<?= $obj['active'] ? 'current-tab' : '' ?>">
                                <?= Html::a($obj['label'], $obj['url']) ?>
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
                            <?= Html::a($obj['label'], $obj['url']) ?>
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
                <div class="section-title">Search</div>
                <div class="section-content">
                    <form method="post" action="">
                        <input type="text" class="text" size="28" /> &nbsp; <input type="submit" class="button" value="Submit" />
                    </form>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Recent Entries</div>
                <div class="section-content">
                    <ul class="nice-list">
                        <li>
                            <div class="left"><a href="#">Aenean tempor arcu..</a></div>
                            <div class="right">Oct 12</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li>
                            <div class="left"><a href="#">Justo interdum rutrum</a></div>
                            <div class="right">Sep 15</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li>
                            <div class="left"><a href="#">In nec justo in urna</a></div>
                            <div class="right">Sep 12</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li>
                            <div class="left"><a href="#">Accumsan condimentum</a></div>
                            <div class="right">Sep 6</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li>
                            <div class="left"><a href="#">Etiam commodo bibendum</a></div>
                            <div class="right">Aug 27</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li>
                            <div class="left"><a href="#">Mauris euismod justo</a></div>
                            <div class="right">Aug 21</div>
                            <div class="clearer">&nbsp;</div>
                        </li>
                        <li><a href="#" class="more">Browse Archives &#187;</a></li>
                    </ul>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Board of Members</div>
                <div class="section-content">
                    <ul class="nice-list">
                        <li><a href="#">Elem Semper</a> <span class="quiet">- Director</span></li>
                        <li><a href="#">Porttitor Urna</a> <span class="quiet">- Lead Writer</span></li>
                        <li><a href="#">Congue Porttitor</a> <span class="quiet">- Editor</span></li>
                        <li><a href="#">Etiam Blandit</a> <span class="quiet">- Writer</span></li>
                        <li><a href="#">Diet Tesque</a> <span class="quiet">- Writer</span></li>
                    </ul>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Topics</div>
                <div class="section-content">
                    <div class="quiet">
                        <a href="#" style="font-size: 120%">vestibulum</a> <a href="#" style="font-size: 120%">ante</a> <a href="#" style="font-size: 150%">ipsum</a> <a href="#" style="font-size: 120%">faucibus</a> <a href="#" style="font-size: 90%">orci luctus</a> <a href="#" style="font-size: 80%">ultrices</a> <a href="#" style="font-size: 220%">posuere cubilia</a> <a href="#" style="font-size: 100%">curae</a> <a href="#" style="font-size: 110%">quisque</a> <a href="#" style="font-size: 150%">ut arcu</a> <a href="#" style="font-size: 140%">eros</a> <a href="#" style="font-size: 100%">vestibulum</a> <a href="#" style="font-size: 90%">dapibus</a> <a href="#" style="font-size: 120%">volutpat</a> <a href="#" style="font-size: 200%">elementum</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div id="footer">
        <div class="left" id="footer-left">
            <img src="img/logo-small.gif" alt="" class="left" />
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
                                <?= Html::a($obj['label'], $obj['url']) ?>
                        <?php if ($obj['active']): ?>
                            </strong>
                        <?php endif; ?>
                            <span class="text-separator">|</span>
                    <?php endforeach; ?>
                    <a href="#top" class="quiet">Page Top &uarr;</a>
                </p>
            <?php endif; ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



<?php return; // --------------------------------------------------------------------------------------------- ?> ?>

<?php

/* @var $this \yii\web\View */
/* @var $content string */


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Миниблог',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Категории', 'url' => '/'],
            ['label' => 'О проекте', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            !Yii::$app->user->isGuest ? ['label' => 'Админка', 'url' => ['/admin']] : '',
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => isset($this->params['homeLink']) ? $this->params['homeLink'] : null,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
