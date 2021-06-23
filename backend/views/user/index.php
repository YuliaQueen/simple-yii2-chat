<?php

use common\models\domains\User;
use common\models\enums\UserType;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover dataTable'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'ФИО',
                'value' => function (User $model, $key, $index, $grid) {
                    return Html::a(Html::encode($model->name), Url::to(['view', 'id' => $model->id]));
                },
                'format' => 'raw',
            ],
            'email',
            [
                'attribute' => 'type',
                'label' => 'Тип',
                'value' => function (User $model) {
                    return UserType::getLabel($model->type);
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
