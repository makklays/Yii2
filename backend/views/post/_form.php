<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

use yii\bootstrap\Modal;
use dosamigos\gallery\Gallery;
use yii\helpers\ArrayHelper;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxLength' => 100]) ?>

    <?= $form->field($model, 'short_descr')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->where(['is_active' => '1'])->orderBy(['title' => 'ASC'])->asArray()->all(), 'id', 'title'),
        ['prompt' => 'Select category']
    ); ?>

    <?php if(isset($items) && !empty($items)): ?>
        <div class="slider-images">
            <?= Gallery::widget(['items' => $items]);?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'imgs[]')->fileInput(['accept' => 'image/*', 'multiple' => true]) ?>

    <?= $form->field($model, 'modified')->widget(DatePicker::className(), [
        //'name' => 'modified',
        //'value' => date('d-m-Y', strtotime('+2 days')),
        //'options' => ['placeholder' => 'Select issue date ...'],
        'language' => 'ru',
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'todayHighlight' => true,
            //'todayBtn' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'is_active')->checkbox(['checked' => '']) ?>

    <br/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
