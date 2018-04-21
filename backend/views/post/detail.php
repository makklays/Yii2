<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\gallery\Gallery;

use common\components\TranslitWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <small>Translit: <?= TranslitWidget::widget(['url' => $model->title]); ?></small>

    <p></p>
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
    <br/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            //'login',
            'short_descr:ntext',
            'description:ntext',
            'imgs',
            'added:datetime',
            'modified',
            //'is_active',
            [
                'format' => 'raw',
                'attribute' => 'is_active',
                'value' => function($dp){
                    return $dp->is_active ? '<span style="color:green;">Да</span>' : '<span class="set-not">Нет</span>';
                }
            ],
        ],
    ]) ?>

    <div class="slider-images">
        <?= Gallery::widget(['items' => $items]);?>
    </div>

</div>
