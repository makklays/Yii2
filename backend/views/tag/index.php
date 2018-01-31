<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        /*'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],*/
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],

            //'id',
            [
                'attribute' => 'id',
                'value' => 'id',
                'headerOptions' => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center; width:90px;'],
            ],
            'name',
            'frequency',

            [
                'class'  => 'yii\grid\ActionColumn',
                'header' => 'Action', // заголовок столбца
                'headerOptions' => ['style' => 'text-align:center;', 'width' => '80'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],
        ],
        'layout' => "{summary}\n{items}\n{pager}",
        'summary' => "Showing {begin} - {end} of {totalCount} items",
    ]); ?>
<?php Pjax::end(); ?></div>
