<?php
namespace backend\controllers;

use backend\models\Post;
use common\models\Author;
use common\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];

        /*return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];*/
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionCreatecategory(){
        $category = new Category();

        $data = \Yii::$app->request->post("Category");

        if(!empty($data)){
            $category->load(\Yii::$app->request->post());
        }

        if(!empty($data) && $category->validate() && $category->save()){
            return $this->render('success_create_category');
        }

        return $this->render('category_edit', [
            'category'  =>  $category,
            'parents'   =>  Category::getList()
        ]);
    }

    public function actionViewpost($id){
        $post = Post::findOne(['id' => $id]);

        if(!$post){
            return $this->run('site/error');
        }

        if(\Yii::$app->request->post("Post")){
            $post->attributes = \Yii::$app->request->post("Post");
            $post->save();
        }

        return $this->render(\Yii::$app->request->get('act') == 'edit' ? 'post_edit' : 'post', [
            'post'  =>  $post
        ]);
    }

    public function actionEditcategory($id){
        $category = Category::findOne(['id' => $id]);

        if(!$category){
            return $this->run('error');
        }

        if(\Yii::$app->request->post("Category")){
            $category->attributes = \Yii::$app->request->post("Category");
            $category->save();
        }

        return $this->render('category_edit', [
            'category'  =>  $category,
            'parents'   =>  Category::getList()
        ]);
    }

    public function actionCategories(){
        return $this->render('categories', [
            'dataProvider'    =>  new ActiveDataProvider([
                'query' =>  Category::find(),
                'pagination'    =>  [
                    'pageSize'  =>  25
                ]
            ])
        ]);
    }

    public function actionPosts(){
        return $this->render('posts', [
            'dataProvider'    =>  new ActiveDataProvider([
                'query' =>  Post::find(),
                'pagination'    =>  [
                    'pageSize'  =>  25
                ]
            ])
        ]);
    }

    public function actionAuthors(){
        return $this->render('authors', [
            'dataProvider'    =>  new ActiveDataProvider([
                'query' =>  Author::find(),
                'pagination'    =>  [
                    'pageSize'  =>  25
                ]
            ])
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
