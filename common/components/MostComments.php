<?php
namespace common\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\Widget;

class MostComments extends Widget
{
    protected $views;
    protected $comments;
    public $countItem = 3;

    public function init()
    {
        // DAO (Database Access Objects) — объекты доступа к базам данным
        $this->views = Yii::$app->db->createCommand('
            SELECT p.id as post_id, p.*, u.*, (SELECT count(id) FROM post_comment pc WHERE pc.post_id = p.id) as count_comment 
            FROM post p JOIN user u ON (p.user_id=u.id) 
            ORDER BY views DESC 
            LIMIT :count ', [':count' => $this->countItem])->queryAll();

        $this->comments = Yii::$app->db->createCommand('
            SELECT p.id as post_id, p.*, u.*, (SELECT count(id) FROM post_comment pc WHERE pc.post_id = p.id) as count_comment 
            FROM post p JOIN user u ON (p.user_id=u.id) 
            ORDER BY count_comment DESC 
            LIMIT :count ', [':count' => $this->countItem])->queryAll();
    }

    public function run()
    {
        echo '<div class="">';
        echo '<h3>MOST COMMENTS</h3>';
        if (isset($this->comments) && !empty($this->comments)) {
            foreach ($this->comments as $comment) {
                echo '<div>';
                    echo '<i class="glyphicon glyphicon-comment"></i>';
                    echo '<span> ' . $comment['count_comment'] . '</span> ';
                    echo Html::a(Html::encode($comment['title']), Url::to(['post/view', 'id' => $comment['id']]));
                echo '</div>';
            }
        } else {
            echo 'Don\'t have the most comments';
        }
        echo '</div>';

        /*echo '<div class="">';
            echo '<h3>MOST VIWES</h3>';
            if (isset($this->views) && !empty($this->views)) {
                foreach($this->views as $view) {
                    echo '<div class="">';
                        echo '<i class="glyphicon glyphicon-eye-open"></i>';
                        echo '<span> '.$view['views'].'</span> ';
                        echo Html::a( Html::encode($view['title']), Url::to(['post/view', 'id' => $view['id']]));
                    echo '</div>';
                }
            }
        echo '</div>';*/
    }
}
