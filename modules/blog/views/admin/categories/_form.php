<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?php //= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'size' => 'ms',
        'template' => '{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView' => 2,
            'maxView' => 2,
            'autoclose' => true,
            'format' => 'dd.mm.yyyy hh:ii:ss', // if inline = false
            'todayBtn' => true
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true , 'class' => 'form-control js-alias-generate-source']) ?>

    <div class="form-group field-categories-alias required">
        <?= Html::label('Алиас', 'alias'); ?>
        <div class="input-group">
            <?= Html::textInput($model->formName() . '[alias]', $model->alias, ['maxlength' => true, 'class' => 'form-control js-alias-generate-alias']); ?>
            <span class="input-group-btn">
                <?= Html::button('Сгенерировать', ['class' => 'btn btn-flat js-alias-generate-btn']) ?>
            </span>
        </div>
    </div>
    <?php  //= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
