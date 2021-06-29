<?php

use common\models\domains\Message;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

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

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>
</div>
