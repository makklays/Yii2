<?php
namespace common\components;

use yii\helpers\Html;
use yii\base\Component;

/**
 * Class Slug
 *
 * Для вызова компонента:
 *
 * use common\components\Slug;
 * $title = 'Заголовок новости';
 * echo Yii::$app->slug->text($title); // выведет: zagolovok-novosti
 *
 * @package common\components
 * @author Alexander Kuziv <makklays@gmail.com>
 */
class Slug extends Component
{
    protected $text;

    public function text($text)
    {
        mb_http_input('UTF-8');
        mb_http_output('UTF-8');
        mb_internal_encoding('UTF-8');

        $this->text = trim($text); // обрезаем пробелы по сторонам
        $this->text = (string)$this->text; // преобразуем в строку
        $this->text = strip_tags($this->text); // убираем HTML-теги
        $this->text = str_replace(array('\n', '\r'), '', $this->text); // заменяем переносы строк

        // переводим строку в нижний регистр (задаем локаль)
        $this->text = function_exists('mb_strtolower') ? mb_strtolower($this->text) : strtolower($this->text);

        // заменяем символы
        $this->text = strtr($this->text, array('а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e',
            'ё' => 'e','ж' => 'j','з' => 'z','и' => 'i','й' => 'y','к' => 'k','л' => 'l','м' => 'm','н' => 'n',
            'о' => 'o','п' => 'p','р' => 'r','с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'c',
            'ч' => 'ch','ш' => 'sh','щ' => 'shch', 'ы' => 'y','э' => 'e','ю' => 'yu','я' => 'ya','ъ' => '','ь' => ''));

        // очищаем строку от недопустимых символов ([] - эти разрешены)
        $this->text = preg_replace('/[^0-9a-z-_ ]/i', '', $this->text);

        // заменяем пробелы знаком минус
        $this->text = str_replace(' ', '-', $this->text);

        return Html::encode($this->text);
    }
}
