<?php
namespace frontend\controllers;

use common\models\Author;
use common\models\Category;
use common\models\Post;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use Yii;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'register', 'login', ],
                        'allow' => true,
                    ],
                    [
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
        ];
    }

    public function actionRenderpage($url){
        $category = Category::findOne(['link'   =>  $url]);

        if(empty($category)){
            return $this->run('site/error');
        }

        $subcategories = Category::findAll(['parent' => $category->id]);
        $posts = Post::findAll(['category' => $category->id]);


        return $this->render('category', [
            'category'  =>  $category,
            'subcategories'=>$subcategories,
            'postsCount'    =>  sizeof($posts),
            'posts'         =>  $posts,
            'premiumPosts'  =>  \common\models\Post::find()->where(['>', 'premium', date('d-m-Y H:i:s')])->andWhere(['category' => $category->id])->all()

        ]);
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'posts'         =>  Post::find()->all(),
            'categories'    =>  Category::find()->where(['parent' => 0])->all()
        ]);
    }

    public function actionPost($id){
        $post = Post::findOne(['id' => $id]);

        return $this->render('post', [
            'post'  =>  $post
        ]);
    }

    public function actionRegister(){
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' =>  $model
        ]);
    }

    public function actionCreatepost(){
        /*if(\Yii::$app->user->isGuest){
            return $this->run('site/login');
        }*/

        $post = new Post();

        $data = \Yii::$app->request->post("Post");

        if(!empty($data)){
            $post->load(\Yii::$app->request->post());
        }

        if(!empty($data) && $post->validate() && $post->save()){
            return $this->render('create_post_success', [
                'post'          =>  $post,
            ]);
        }else{
            return $this->render('create_post', [
                'post'          =>  $post,
                'categoryList'  =>  Category::getList(),
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest && \Yii::$app->request->url == 'login') {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionMyaccount(){
        return $this->run('account', ['id' => \Yii::$app->user->identity->id]);
    }

    public function actionAccount($id){
        $account = Author::findOne(['id' => $id]);

        if(!$account){
            return $this->run('error');
        }

        return $this->render('account', [
            'account'   =>  $account
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', \Yii::t('site', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', \Yii::t('site', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
