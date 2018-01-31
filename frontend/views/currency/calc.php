<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('main', 'Currency calculator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main','Currencies rate'), 'url' => ['currency/index']];
$this->params['breadcrumbs'][] = ['label' => 'UAH'];
//$this->params['breadcrumbs'][] = ['label' => 'UAH', 'url' => ['currency/stat', 'cc' => 'UAH']];
$this->params['breadcrumbs'][] = $this->title;

?>

<!--div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" aria-label="...">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
        </div>
    </div>
</div-->

<style>
    /*#frmCalc input, #frmCalc select {
        font-size: 30px;
        height: 52px;
    }*/
</style>

<form id="frmCalc" name="form_calc" action="" method="post" >
    <div class="form-group">
        <input class="form-control" name="from" placeholder="100" value="100" type="text" style=" max-width: 140px; display: inline;" />
        <select class="form-control" name="short_title" style="max-width: 300px; display: inline;">
            <?php foreach($currencies as $val): ?>
                <option value="<?=$val->short_title?>"><?=$val->short_title?> <?=$val->title?></option>
            <?php endforeach; ?>
        </select>
         =
        <input class="form-control" name="to" value="" type="text" style="max-width: 140px; display: inline;" />
        грн.
        <!--select class="form-control" name="val_to" style="max-width: 220px; display: inline;">
            <?php foreach($currencies as $val): ?>
                <option value="<?=$val->short_title?>"><?=$val->short_title?> <?=$val->title?></option>
            <?php endforeach; ?>
        </select-->
    <!--/div>

    <div class="form-group" -->
        <input class="btn btn-success btn-xlg-specific" type="submit" name="sum" value="Рассчитать" />
    </div>
</form>

<?php
$js = <<<JS
    $('#frmCalc').on('submit', function(){
        //alert('Работает!');
        
        var form = $(this);
        //console.log(data);
        
        $.ajax({
            url: '/en/currency/calc',
            type: 'POST',
            data: form.serialize(),
            success: function(res){
                console.log(res);
                $('input[name=to]').val(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
JS;

$this->registerJs($js);
?>
