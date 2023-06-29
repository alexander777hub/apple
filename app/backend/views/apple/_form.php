<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Apple $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="apple-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'spent')->input('number', ['min'=>0,'max'=>100]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>