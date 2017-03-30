<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->listCategories()) ?>

    <?= $form->field($model, 'date')->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
        'language' => 'ru',
        'size' => 'ms',
        'template' => '{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView'   => 2,
            'maxView'   => 2,
            'autoclose' => true,
            'format'    => 'dd.mm.yyyy',
            'todayBtn'  => true
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true , 'class' => 'form-control js-alias-generate-source']) ?>

    <?= $form->field($model, 'alias', ['template' => $this->renderFile('@app/views/parts/admin/aliasInput.php')])
        ->textInput(['class' => 'form-control js-alias-generate-alias']); ?>

    <?= $form->field($model, 'text')->widget(\dosamigos\tinymce\TinyMce::className());?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',
                                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
