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

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
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

    <?= $form->field($model, 'text')->widget(\dosamigos\tinymce\TinyMce::className() , [
        'options' => ['rows' => 20],
        'language' => 'ru',
        'clientOptions' => [
            'class' => 'form-control',
            'classes' => 'form-control',
            'plugins' => [
                "advlist autolink lists charmap print preview anchor link",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste "
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',
                                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
