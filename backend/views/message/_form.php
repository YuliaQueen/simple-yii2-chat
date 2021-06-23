<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\domains\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_user_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_correct')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
