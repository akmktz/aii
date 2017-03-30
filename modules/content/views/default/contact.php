<?php
/* @var $this yii\web\View */
$this->title = $page->h1 ?: $page->name;
$this->params['homeLink'] = false;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<p><?= \yii\helpers\HtmlPurifier::process($page->text); ?> </p>
    <div class="comment-body contact-form">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <fieldset>
            <div class="form-row">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'text']); ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'text']); ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'text')->textarea(['rows' => 6, 'maxlength' => true]) ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className()) ?>
            </div>
            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'contact-submit-btn']) ?>
        </fieldset>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
    <div class="clearer">&nbsp;</div>