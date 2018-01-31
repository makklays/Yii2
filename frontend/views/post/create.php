<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

use dosamigos\gallery\Gallery;

use yii\helpers\ArrayHelper;
use backend\models\Category;
use dosamigos\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;

$this->title = Yii::t('main','Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main','All posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('main','My posts'), 'url' => ['my']];
$this->params['breadcrumbs'][] = $this->title;

$items = [];
?>
<div class="post-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxLength' => 100]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxLength' => 100]) ?>

    <?= $form->field($model, 'short_descr')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>

    <!--?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
    ]); ?-->

    <!-- $form->field($model, 'description')->widget(CKEditor::className(), [
        'preset' => 'basic',
        //'preset' => 'full',
        //'preset' => 'basic',
        //'clientOptions' => [
        //    'filebrowserUploadUrl' => 'ckeditor/url'
        //]
    ]); -->

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->where(['is_active' => '1'])->orderBy(['title' => 'ASC'])->asArray()->all(), 'id', 'title'),
        ['prompt' => Yii::t('main','Select category')]
    ); ?>

    <div class="form-group field-post-title">
        <label class="control-label" for="tags"><?=Yii::t('main','Tags')?></label>
        <input type="text" id="tags" name="tags" value="" class="form-control" />
    </div>

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
        <?= Html::submitButton(Yii::t('main','Create'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
    CKEDITOR.replace( 'Post[description]', {
        //preset: 'basic',
        //language: 'ru',
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


<!-- без ActiveForm -->
<!--
<form method="POST">
    <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>

    <input type="submit" value="ok!">
</form>
-->
