<?php

use Yii\t;
use yii\i18n;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->params['breadcrumbs'][] = ['label' => Yii::t('main','All posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $date;
?>

<div class="post-day">

    <h1><?=$date?> <small><?=Yii::t('main', 'Posts')?></small></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>

    <!--h3><?=Yii::t('main', 'Posts')?></h3-->

</div>
