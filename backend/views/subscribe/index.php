<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscribes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subscribe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align:center; width:45px;'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],
            //'id',
            [
                'attribute' => 'id',
                'headerOptions'  => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center; width:100px; max-width:100px; min-width:100px;'],
                'value' => 'id',
            ],
            'uname',
            'email:email',
            [
                'format' => 'raw',
                'attribute' => 'is_subscribe',
                'value' => function($dataProvider) {
                    // 'is_subscribe'
                    //return $dataProvider->is_subscribe;
                    //return ($dataProvider->is_subscribe == 1 ? '<span class="success">Да</span>' : '<span class="not-set">Нет</span>');
                    return Html::decode(Html::decode($dataProvider->is_subscribe == 1 ? '<span style="color:green;">Да</span>' : '<span class="not-set">Нет</span>'));
                },
                //'filter' => Html::activeDropDownList($searchModel, 'is_subscribe', \yii\helpers\ArrayHelper::map(\backend\models\Subscribe::find()->groupBy('is_subscribe')->all(), 'id', 'is_subscribe'), ['class' => 'form-control', 'prompt' => '']),
                'filter' => Html::activeDropDownList($searchModel, 'is_subscribe', ['0' => 'Нет', '1' => 'Да'], ['class' => 'form-control', 'prompt' => 'Select']),
                'headerOptions' => ['style' => 'width:110px;'],
            ],
            //'is_subscribe',
            //'added:date',
            //'ip',
            [
                'attribute' => 'ip',
                'value' => 'ip',
                'headerOptions' => ['style' => 'width:90px;'],
            ],
            [
                'attribute' => 'added',
                'format' => ['date', 'php:d-m-Y H:i'],
                'contentOptions' => ['style' => 'width:110px;'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action', // заголовок столбца
                'headerOptions' => ['style' => 'text-align:center; width:90px;'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
