<?php
use yii\helpers\Url;

$this->title = Yii::t('main', 'Currencies rate');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Iноземнi валюти <small><?=$today?></small></h1>

<?php if(isset($currencies) && !empty($currencies)): ?>
<div class="table-responsive">
    <div style="margin-bottom: 10px;">Офіційний курс гривні щодо іноземних валют </div>

    <table class="table table-hover">
    <thead>
        <tr>
            <th>Код цифровий</th>
            <th>Код літерний</th>
            <th>Кількість одиниць</th>
            <th class="text-left">Назва валюти</th>
            <th>Офіційний курс</th>
            <th>Rate</th>
        </tr>
    </thead>
    <?php foreach($currencies as $c): ?>

        <tr>
            <td><?=$c['r030']?></td>
            <td><?=$c['short_title']?></td>
            <td>100</td>
            <td class="text-left">
                <a href="<?=Url::to(['currency/stat', 'cc' => $c['short_title']])?>" title="Статистика">
                    <?=$c['title']?>
                </a>
            </td>
            <td><?=(100 * $c['rate'])?></td>
            <td><?=round($c['rate'], 4)?></td>
        </tr>

    <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>


