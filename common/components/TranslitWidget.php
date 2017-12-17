<?php
namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class TranslitWidget
 *
 * Для вызова виджета:
 *
 * use common\components\TranslitWidget;
 * $title = 'Заголовок новости';
 * echo TranslitWidget::widget(['url' => $title]); // выведет: zagolovok-novosti
 *
 * @package common\components
 */
class TranslitWidget extends Widget
{
    public $url;

    public function init()
    {
        parent::init();

        mb_http_input('UTF-8');
        mb_http_output('UTF-8');
        mb_internal_encoding('UTF-8');

        $this->url = (string)$this->url; // преобразуем в строку
        $this->url = strip_tags($this->url); // убираем HTML-теги
        $this->url = str_replace(array('\n', '\r'), '', $this->url); // заменяем переносы строк
        $this->url = trim($this->url); // обрезаем пробелы по сторонам

        // переводим строку в нижний регистр (задаем локаль)
        $this->url = function_exists('mb_strtolower') ? mb_strtolower($this->url) : strtolower($this->url);

        // заменяем символы
        $this->url = strtr($this->url, array('а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e',
            'ё' => 'e','ж' => 'j','з' => 'z','и' => 'i','й' => 'y','к' => 'k','л' => 'l','м' => 'm','н' => 'n',
            'о' => 'o','п' => 'p','р' => 'r','с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'c',
            'ч' => 'ch','ш' => 'sh','щ' => 'shch', 'ы' => 'y','э' => 'e','ю' => 'yu','я' => 'ya','ъ' => '','ь' => ''));

        // очищаем строку от недопустимых символов ([] - эти разрешены)
        $this->url = preg_replace('/[^0-9a-z-_ ]/i', '', $this->url);

        // заменяем пробелы знаком минус
        $this->url = str_replace(' ', '-', $this->url);
    }

    public function run()
    {
        return Html::encode($this->url);
    }
}
