<?php
/* @var $this yii\web\View */
$this->title = $post->name;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['group', 'groupAlias' => $group->alias]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="post">
    <div class="post-body">
        <p><?= trim(\yii\helpers\HtmlPurifier::process($post->text)); ?> </p>
    </div>
    <div class="post-date"><?= $post->date; ?></div>
</div>
<div class="archive-separator"></div>
<?php if(count($result)): ?>
    <div id="comments">
    <div class="left">
        <h2>Отзывов: <?= count($result) ?></h2>
    </div>
    <h3 class="right">
        <a href="#respond">Оставить отзыв &#187;</a>
    </h3>
    <div class="clearer">&nbsp;</div>
    <div class="comment-list-wrapper">
        <ul class="comment-list">
            <?php foreach($result as $obj): ?>
                <li class="comment comment-single" id="comment-<?= $obj->id ?>">
                    <div class="comment-profile-wrapper left">
                        <div class="comment-profile">
                            <div class="comment-gravatar">
                                <img src="/img/sample-gravatar.gif" width="40" height="40" alt="" />
                            </div>
                            <div class="comment-author"><?= $obj->name ?></div>
                        </div>
                    </div>
                    <div class="comment-content-wrapper right">
                        <div class="comment-content-wrapper-2">
                            <div class="comment-body">
                                <div class="comment-arrow"></div>
                                <div class="post-date">
                                    <div class="left"><?= $obj->date ?></div>
                                    <div class="clearer">&nbsp;</div>
                                </div>
                                <div class="comment-text">
                                    <p><?= $obj->text ?></p>
                                </div>
                                <div class="clearer">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="clearer">&nbsp;</div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
<div id="respond">
    <ul>
        <li>
            <div class="legend" id="comment-form-title">
                Оставить отзыв
                <div class="premoder">Внимание! На сайте действует премодерация.</div>
            </div>
            <div class="comment-profile-wrapper left">
                <div class="comment-profile">
                    <div class="comment-gravatar"><img src="/img/sample-gravatar.gif" width="40" height="40" alt="Your gravatar" /></div>
                    <div class="comment-author"></div>
                </div>
            </div>
            <div class="comment-content-wrapper">
                <div class="comment-body">
                    <div class="comment-arrow"></div>
                    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
                        <fieldset>
                            <?= $form->field($model, 'post_id')->hiddenInput()->label(false) ?>
                            <div class="form-row comment-input-text">
                                <?= $form->field($model, 'text')->textarea(['rows' => 6, 'maxlength' => true])
                                        ->label(false) ?>
                            </div>
                            <div class="form-row comment-input-name">
                                <?= $form->field($model, 'name',
                                    ['template' => $this->renderFile('@app/views/parts/commentInput.php')])
                                    ->textInput(['maxlength' => true, 'class' => 'text']); ?>
                            </div>
                            <div class="form-row comment-input-email">
                                <?= $form->field($model, 'email',
                                    ['template' => $this->renderFile('@app/views/parts/commentInput.php')])
                                    ->textInput(['maxlength' => true, 'class' => 'text']); ?>
                            </div>
                            <div class="form-row form-row-submit">
                                <?= \yii\helpers\Html::submitButton('Добавить') ?>
                            </div>
                        </fieldset>
                    <?php \yii\widgets\ActiveForm::end(); ?>
                </div>
                <div class="clearer">&nbsp;</div>
            </div>
            <div class="clearer">&nbsp;</div>
        </li>
    </ul>
</div>