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
use dosamigos\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;
use yii\imperavi;

$this->title = Yii::t('main', 'Update Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main','All posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('main','My posts'), 'url' => ['my']];
$this->params['breadcrumbs'][] = Html::encode($model->title);
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="post-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxLength' => 100]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxLength' => 100]) ?>

    <?= $form->field($model, 'short_descr')->textarea(['rows' => 5]) ?>

    <!--?= $form->field($model, 'description')->textarea(['rows' => 10]) ?-->

    <!-- $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 20],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]); -->

    <!--?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 10],
        //'preset' => 'basic',
        'preset' => 'full',
        //'inline' => false,
        'clientOptions' => ['language' => 'ru'],
        //'clientOptions' => ['extraPlugins' => 'codesnippet']
    ]); ?-->

    <?= $form->field($model, 'description')->textarea(['rows' => 20]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->where(['is_active' => '1'])->orderBy(['title' => 'ASC'])->asArray()->all(), 'id', 'title'),
        ['prompt' => Yii::t('main','Select category')]
    ); ?>

    <div class="form-group field-post-title">
        <label class="control-label" for="tags"><?=Yii::t('main', 'Tags')?></label>
        <input type="text" id="tags" name="tags" value="<?=$tags?>" class="form-control" />
    </div>

    <?php if(isset($items) && !empty($items)): ?>
        <div class="slider-images">
            <?= Gallery::widget(['items' => $items]);?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'imgs[]')->fileInput(['accept' => 'image/*', 'multiple' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox(['checked' => '']) ?>

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

    <br/>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
    CKEDITOR.replace( 'Post[description]', {
        //options: {rows: 20},
        //preset: 'basic',
        preset: 'full',
        language: 'ru',
        //toolbarCanCollapse: true,
        //uiColor: '#AADC6E',
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'monokai_sublime'
    });
    CKEDITOR.config.codeSnippet_languages = {
        javascript: 'JavaScript',
        php: 'PHP'
    };
    
    
JS;
$this->registerJs($js);
?>
