<?php

use common\models\domains\Message;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domains\Message */

$this->title = 'Сообщение от: ' . $model->createdBy->name . ' | ' . date('d M Y', $model->created_at);
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="message-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'is_correct:boolean',
            'deleted_at:boolean',
            [
                'attribute' => 'created_at',
                'format' => ['date','php:d-m-Y H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date','php:d-m-Y H:i:s'],
            ],
            [
                'attribute' => 'created_by_id',
                'value' => function (Message $model) {
                    return $model->createdBy->name;
                },
            ],
            [
                'attribute' => 'updated_by_id',
                'value' => function (Message $model) {
                    return $model->updatedBy->name;
                },
            ],
        ],
    ]) ?>

</div>
