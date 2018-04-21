<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout' => "{sorter}\n{pager}\n{summary}\n{items}",
        //'summary' => '', // скрыть
        //'showFooter' => true, // показать
        'showHeader' => true, // показать
        'showOnEmpty' => true, // показывать всегда - Скрытие, отображение не заполненного Gridview
        //'emptyCell' => '-', // если ячейка пустая, отобразится прочерк
        'rowOptions' => function ($model, $key, $index, $grid){
            $class=$index%2?'odd':'even';  // стилизация четной и нечетной строки
            return array('key'=>$key,'index'=>$index,'class'=>$class);
        },
        'layout' => "{summary}\n{items}\n{pager}",
        'summary' => "Showing {begin} - {end} of {totalCount} items",

        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],

            // 'id',
            [
                'attribute' => 'id',
                'value' => 'id',
                'contentOptions' => ['style' => 'text-align:center; width:90px;'],
            ],
            'title',
            [
                'format' => 'raw',
                'label' => 'Category',
                //'attribute' => 'category.title',
                'value' => function($dataProvider) {
                    if (isset($dataProvider->category) && !empty($dataProvider->category->title)) {
                        //return $dataProvider->category->title;
                        return Html::a($dataProvider->category->title, ['category/view', 'id' => $dataProvider->category->id]);
                    } else {
                        return null;
                    }
                },
                //'filter' => '',
            ],

            [
                'format' => 'raw',
                'attribute' => 'is_active',
                'label' => 'Is active',
                'value' => function($dataP){
                    return Html::decode(Html::decode($dataP->is_active == 1 ? '<span style="color:green;">Да</span>' : '<span class="not-set">Нет</span>'));
                },
                'filter' => Html::activeDropDownList($searchModel, 'is_active', ['0' => 'Нет', '1' => 'Да'], ['class' => 'form-control', 'prompt' => 'Select']),
            ],

            //'category_id',
            //'user_id',
            [
                'format' => 'raw',
                'label' => 'Login',
                'value' => function($dp) {
                    if (isset($dp->user->username) && !empty($dp->user->username)) {
                        return Html::a(Html::encode($dp->user->username), ['user/view', 'id' => $dp->user->id]);
                    } else {
                        return null;
                    }
                },
            ],
            [
                'format' => 'raw',
                'label' => 'Tags',
                'value' => function($dp) {
                    if (isset($dp->tags) && !empty($dp->tags)) {
                        foreach($dp->tags as $tag){
                            $tags_arr[] = $tag->name;
                            /*echo '<pre>';
                            print_r($tags_arr);
                            echo '</pre>';*/
                        }
                        $tags = implode(',<br/>', $tags_arr);

                        return $tags;
                        //return '<pre>' . print_r($dp->tags) . '</pre>';
                        //return Html::a(Html::encode($dp->tags), ['user/view', 'id' => $dp->user->id]);
                    } else {
                        return null;
                    }
                },
            ],
            //'username',
            //'description:ntext',
            //'imgs',
            //'added',
            //'modified',
            [
                'attribute' => 'modified',
                'value' => 'modified',
                'contentOptions' => ['style' => 'text-align:center; width:90px;'],
            ],

            // Простой вариант. Автоматическое формирование изображения
            //'imgs:image',
            // Второй вариант. Формирование изображения и его параметров через анонимную функцию
            [
                'label' => 'Count Images',
                'format' => 'raw',
                'headerOptions' =>  ['width' => '50', 'style' => 'text-align:center;' ],
                'contentOptions' => ['class' => 'table-hover', 'style' => 'text-align:center;' ],
                'value' => function($data){
                    $arr = '';
                    $img_arr = explode(',', $data->imgs);
                    if(isset($img_arr) && !empty($img_arr)) {
                        foreach($img_arr as $file) {
                            $img = '/uploads/posts/' . $data->id . '/' . $file;

                            $arr .= Html::img($img, [
                                'alt' => '.',
                                'style' => 'height:50px;'
                            ]).' ';
                        }
                    }

                    return count($img_arr);
                    //return $arr;
                    /* for one image
                    return Html::img(Url::toRoute(['product/view', 'id' => 42]),[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:15px;'
                    ]);*/
                },
            ],

            // Добавляем изображение
            /*[
                'label'=>'Изображение',
                'format'=>'raw',
                'value' => function($data){
                    $url = "http://www.mysite.ru/logo.png";
                    return Html::img($url,['alt'=>'myimage']);
                }
            ],*/

            // Добавляем ссылку
            /*[
                'label'=>'Ссылка',
                'format'=>'raw',
                'value' => function($data){
                    $url = "http://www.mysite.ru";
                    return Html::a('Перейти', $url, ['title' => 'Перейти']);
                }
            ],*/

            // Добавляем выпадающий список
            /*[
                'label' => 'выпадающий список',
                'attribute' => 'isactive',
                'filter' => array("1" => "Активный", "2" => "Не активный"),
                //TblCategory::get_status(), // функция получения статуса из модели
            ],*/
            /*
            public static  function  get_status(){
                $cat = TblCategoryStatus::find()->all(); // выбор всего из таблицы
                $cat = ArrayHelper::map($cat, 'id', 'name'); // приводим к формату выпадающего списка
                return $cat;
            } */

            [
                'class'     => 'yii\grid\ActionColumn',
                'header'    => 'Действия', // заголовок столбца
                'headerOptions' => ['style' => 'text-align:center; width:80px;'],
                'contentOptions' => ['style' => 'text-align:center;'],
                'template'      => '{view} {update} {delete} {link}', // кнопка просмотра, изменения, удаления, ссылка
                'buttons' => [
                    /*'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"></span>',
                            $url);
                    },*/
                    'link' => function ($url,$model,$key) {
                        //$url = Yii::$app->request->hostinfo . '/index.php/post/neo/' . $model->id;
                        $url = Url::to(['post/neo', 'id' => $model->id]);
                        return Html::a('neo', $url);
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

