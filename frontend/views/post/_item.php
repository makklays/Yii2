<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12" style="border-bottom: #ddd 1px dashed; padding-bottom: 20px;">
        <!--h2><a href="<?=Url::to(['post/view', 'slug' => $model['slug']])?>"><?= Html::encode($model['title'])?> <?=($model['views'] == 0 ? '<sup style="color:red;">NEW</sup>' : '')?></h2-->

        <h2><?=Html::a(Html::encode($model['title']), Url::to(['post/view', 'slug' => $model['slug']]))?> <?=($model['views'] == 0 ? '<sup style="color:red;">NEW</sup>' : '')?></h2>

        <!--div><i><?= Html::encode($model['slug']) ?></i></div-->

        <div class="row">
            <div class="col-md-12" style="margin-top:10px; margin-bottom:10px;">
                <div class="" style="float:left; margin-right:20px;">
                    <i class="glyphicon glyphicon-calendar"></i>
                    <span> <?= $model['modified'] ?></span>
                </div>
                <div class="" style="float:left; margin-right:20px;">
                    <i class="glyphicon glyphicon-user"></i>
                    <span> <?= Html::a($model['username'], ['profile/view', 'id' => $model['user_id']]); ?></span>
                </div>
                <div class="" style="float:left; margin-right:20px;">
                    <i class="glyphicon glyphicon-comment"></i>
                    <span> <?= $model['count_comment']?></span>
                </div>
                <div class="" style="float:left; margin-right:20px;">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    <span> <?= $model['views'] ?></span>
                </div>

                <?php if (isset($model['category_title']) && !empty($model['category_title'])): ?>
                    <div class="" style="float:left; margin-right:20px;">
                        <i class="glyphicon glyphicon-folder-open"></i>
                        <span> <?= Html::a($model['category_title'], ['post/index', 'category' => $model['category_id']]) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (isset($model['tags']) && !empty($model['tags'])): ?>
                    <div class="" style="float:left; margin-right:20px;">
                        <i class="glyphicon glyphicon-tags"></i>
                        <span> <?= implode(', ', $model['tags']) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!--div style="clear:both;"></div-->

        <div class="row">
            <div class="col-md-12">
                <a href="<?= Url::to(['post/view', 'id' => $model['post_id']])?>">
                    <?php if(isset($model['img']) && !empty($model['img']) && file_exists( Yii::$app->basePath . '/web/'. $model['img'])): ?>
                        <img src="<?=$model['img']?>" class="img-responsive" alt="Yii2" width="847" />
                    <?php else: ?>
                        <img src="/users/none.png" class="img-responsive" alt="Yii2" width="847" />
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px;">
                <p><?= nl2br(HtmlPurifier::process($model['short_descr'])) ?></p>
                <p><?= Html::a(Yii::t('main', 'Read More').' &raquo;', Url::to(['post/view', 'slug' => $model['slug']]), ['class' => 'btn btn-default']); ?></p>
            </div>
        </div>

        <!--div class="row">
            <div class="col-md-2">
                <a href="<?= Url::to(['post/view', 'id' => $model['post_id']])?>">
                    <?php if(isset($model['img']) && !empty($model['img']) && file_exists( Yii::$app->basePath . '/web/'. $model['img'])): ?>
                        <img src="<?=$model['img']?>" class="img-responsive" alt="Yii2" height="100" />
                    <?php else: ?>
                        <img src="/users/none.png" class="img-responsive" alt="Yii2" height="100" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-md-10">
                <p><?= nl2br(HtmlPurifier::process($model['short_descr'])) ?></p>
                <p><?= Html::a(Yii::t('main', 'Read More').' &raquo;', Url::to(['post/view', 'slug' => $model['slug']]), ['class' => 'btn btn-default']); ?></p>
            </div>
        </div-->

    </div>
</div>


