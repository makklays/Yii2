<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = Yii::t('main', 'Contact');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact" style="/*background-color:#94dc8a;*/ padding-left:10px; margin-top:-20px;">

    <section>
        <div class="container inner-top ">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?=Yii::t('main', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')?>
                </p>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('main','Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-6 col-md-6" style="background-color:#e3e3e3; height:700px;">
                <div class="thumbnail" style="background-color:#e3e3e3; border: 0px dashed #ddd; margin-top:130px;">
                    <img class="" style="width:550px; " src="<?=Url::to('/imgs/contacts.png')?>" alt="contact" />
                </div>
            </div>
        </div>
        </div>
    </section>

</div>
