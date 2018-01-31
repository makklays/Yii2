<?php

use Yii\t;
use yii\i18n;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'All posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('post', 'All posts');
?>

<h1><?= Yii::t('post', 'All posts') ?></h1>

<!--
<?php if(!Yii::$app->user->isGuest): ?>
    <p><?= Html::a(Yii::t('post', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?></p>
<?php endif; ?>
-->

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_item',
]); ?>

