<?php
namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use backend\models\UploadForm;
use backend\models\PostForm;

/**
 * PostController implements the CRUD actions for Post model.
 *
 * @author Alexander Kuziv <makklays@gmail.com>
 * @package frontend\controllers
 */
class PostController extends Controller
{
    public $layout = 'main2';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $items = [];
        if (isset($model->imgs) && !empty($model->imgs)) {
            $imgs_arr = explode(',', $model->imgs);
            foreach($imgs_arr as $img){
                $items[] = [
                    'url' => '/uploads/posts/' . '/' . $model->id . '/' . $img,
                    'src' => '/uploads/posts/' . '/' . $model->id . '/' . $img,
                    'options' => ['title' => '']
                ];
            }
        }

        return $this->render('view', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        // insert
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // get $_FILES
            $files = UploadedFile::getInstances($model, 'imgs');

            if (isset($files) && !empty($files)) {
                $files_arr = []; $files_str = NULL;
                foreach($files as $file) {

                    // create directory
                    $path = Yii::$app->basePath . '/web/uploads/posts/' . $model->id;
                    if (!file_exists($path)) {
                        mkdir($path, 0700);
                    }

                    // upload file
                    // 800x400, 392x272, 130x90
                    $file->saveAs('uploads/posts/' . $model->id . '/' . $file->baseName . '.' . $file->extension);
                    $files_arr[] = $file->baseName . '.' . $file->extension;
                }
                $files_str = implode(',', $files_arr);

                // add files
                $model->imgs = $files_str;
            }

            $model->added = time();
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);

        } else { // view form for create

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // images
        $items = [];
        if (isset($model->imgs) && !empty($model->imgs)) {
            $imgs_arr = explode(',', $model->imgs);
            foreach($imgs_arr as $img){
                $items[] = [
                    'url' => '/uploads/posts/' . '/' . $model->id . '/' . $img,
                    'src' => '/uploads/posts/' . '/' . $model->id . '/' . $img,
                    'options' => ['title' => '']
                ];
            }
        }

        // update
        if ($model->load(Yii::$app->request->post())) {

            $files = UploadedFile::getInstances($model, 'imgs');

            if (isset($files) && !empty($files)) {
                $files_arr = []; $files_str = NULL;
                foreach($files as $file) {

                    // create directory
                    $path = Yii::$app->basePath . '/web/uploads/posts/' . $model->id;
                    if (!file_exists($path)) {
                        mkdir($path, 0700);
                    }

                    // upload file
                    $file->saveAs('uploads/posts/' . $model->id . '/' . $file->baseName . '.' . $file->extension);
                    $files_arr[] = $file->baseName . '.' . $file->extension;
                }
                $files_str = implode(',', $files_arr);

                // add files
                $model->imgs = $files_str;
            }

            $model->added = strtotime($model->modified);
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);

        } else { // view form for update

            return $this->render('update', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        $dir_img = Yii::getAlias('@webroot') . '/uploads/posts/' . $id;

        print_r($dir_img);
        exit;

        //rmdir($dir_img);

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
