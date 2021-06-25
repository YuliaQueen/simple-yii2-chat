<?php

use common\models\domains\Calendar;
use common\models\domains\User;
use common\models\enums\Department;
use common\models\enums\Employment;
use common\models\enums\EventType;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domains\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="container-fluid user-view">
    <p>
        <?= Html::a(
            'Удалить',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]
        ) ?>
    </p>

    <?= DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'name',
                    'label' => 'ФИО',
                ],
                'email:email',

            ],
        ]
    ) ?>

</div>
