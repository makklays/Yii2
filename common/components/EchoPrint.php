<?php
namespace common\components;

use yii\base\Component;

/**
 * Class EchoPrint - простой пример,
 * часто используемого кода для отображения содержимого
 *
 * Незабываем подключить в конфиге common/config/main-local.php
 * return [
 *     'components' => [
 *         // ...
 *         'echo' => [
 *             'class' => 'common\components\EchoPrint',
 *         ]
 *     ]
 * ];
 *
 * Для вызова виджета:
 * use common\components\EchoPrint;
 * $arr = ['1','a','bc','d' => '10'];
 * Yii::$app->EchoPrint->pre($arr, 1);
 *
 * @package common\components
 * @author Alexander Kuziv <makklays@gmail.com>
 */
class EchoPrint extends Component
{
    public function pre($array = null, $exit = null)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';

        if (!is_null($exit)) {
            exit;
        }
    }
}
