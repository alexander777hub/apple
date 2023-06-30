<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Apple $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="apple-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'size')->input('numerical', ['readOnly' => true])->label(Yii::t('app', 'Count')) ?>
    <?= $form->field($model, 'initial_size')->input('numerical', ['readOnly' => true])->label(Yii::t('app', 'Initial Count')) ?>

    <?= $form->field($model, 'spent_value')->input('numerical')->label(Yii::t('app', 'Enter a valid value 0.01 - 1')) ?>
    <div class="form-group">
        <?= Html::submitButton('Cut', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>