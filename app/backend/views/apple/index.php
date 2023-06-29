<?php

use app\models\Apple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AppleSearch $searchModel */
/** @var app\models\Apple $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Apple', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'color',
                'format'=>'html',
                'value' => function ($model) {
                    $color_list = \backend\models\AppleCreator::$colors;
                    return  isset($color_list[$model->color]) ? $color_list[$model->color] : "Not set";
                },
            ],
            'date_appear',
            'size',
            'date_fall',
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'status',
                'format'=>'html',
                'value' => function ($model) {
                    $status_list = Apple::getStatusArray();
                    return  isset($status_list[$model->status]) ? $status_list[$model->status] : "Not set";
                },
            ],
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'spent',
                'format'=>'html',
                'value' => function ($model) {
                    return $model->spent . '%';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update}{delete}',
                'urlCreator' => function ($action, Apple $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
            [
                'class' => yii\grid\DataColumn::className(),
                'format'=>'html',
                'value' => function ($model) {
                    if($model->status == 3 || $model->status == 2) {
                        return '';
                    }
                    return Html::a(Yii::t('app', 'Уронить'), ['apple/fall-down', 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>


</div>