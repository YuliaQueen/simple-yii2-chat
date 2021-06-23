<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\domains\Message */

$this->title = $this->title = 'Изменить сообщение от: ' . $model->createdBy->name . ' | ' . date('d M Y', $model->created_at);
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="message-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
