<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?php //= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
    //    'options' => ['placeholder' => 'Enter event time ...'],
    //    'pluginOptions' => [
    //        'autoclose' => true
    //    ]
    //]); ?>

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
