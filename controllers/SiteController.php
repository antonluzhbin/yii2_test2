<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Category;
use app\models\News;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    public function actionIndex($cat = NULL)
    {
        $category = new Category;
        $dataCategory = $category->find()->all();
        
        $path = $category->path();
                
        $news = new News;
        
        if ($cat)
        {
            $dataNews = $news->find()->where(['category' => $cat])->all();
        }
        else
        {
            $dataNews = $news->find()->all();
        }
    
        return $this->render('index', array(
            'category' => $dataCategory,
            'news' => $dataNews,
            'cpath'=> $path
        ));
    }
    
    public function actionNews($id = NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');
        
        $news = new News;
        $data = $news::find()->where(['id' => $id])->one();

        if ($data === NULL)
            throw new HttpException(404, 'Document Does Not Exist');
    
        return $this->render('news', array(
            'data' => $data
        ));
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
    
    public function actionEditcategory()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $category = new Category;
        $dataCategory = $category->find()->all();
        
        $path = $category->path();
           
        return $this->render('editcategory', array(
            'category' => $dataCategory,
            'cpath' => $path
        ));
    }
    
    public function actionEditnews()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $category = new Category;
        $dataCategory = $category->find()->all();
        
        $catname = Array();
        foreach ($dataCategory as $cat)
        {
            $catname[$cat['id']] = $cat['name'];
        }

        $news = new News;
        $dataNews = $news->find()->all();
           
        return $this->render('editnews', array(
            'category' => $catname,
            'news' => $dataNews
        ));
    }
           
    public function actionUpdatecategory($id=NULL)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $model = Category::find()->where(['id' => $id])->one();

        if ($model === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        if (isset($_POST['Category']))
        {
            if ($model->id == $_POST['Category']['parent'])
            {
                Yii::$app->session->setFlash('CategoryParentError');
                
                $category = new Category;
                $dataCategory = $category->findName();

                echo $this->render('updatecategory', array(
                    'model' => $model,
                    'category' => $dataCategory
                ));
                return;
            }
                    
            $model->name = $_POST['Category']['name'];
            $model->active = $_POST['Category']['active'];
            $model->parent = $_POST['Category']['parent'];
            
            if ($model->save())
            {
                Yii::$app->response->redirect(array('site/editcategory'));
                return;
            }
        }
        
        $category = new Category;
        $dataCategory = $category->findName();

        echo $this->render('updatecategory', array(
            'model' => $model,
            'category' => $dataCategory
        ));
    }
    
    public function actionUpdatenews($id=NULL)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $model = News::find()->where(['id' => $id])->one();

        if ($model === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        if (isset($_POST['News']))
        {                    
            $model->active = $_POST['News']['active'];
            $model->title = $_POST['News']['title'];
            $model->image = $_POST['News']['image'];
            $model->description = $_POST['News']['description'];
            $model->text = $_POST['News']['text'];
            $model->date = $_POST['News']['date'];
            $model->category = $_POST['News']['category'];
            
            if ($model->save())
            {
                Yii::$app->response->redirect(array('site/editnews'));
                return;
            }
        }
        
        $category = new Category;
        $dataCategory = $category->findName();

        echo $this->render('updatenews', array(
            'model' => $model,
            'category' => $dataCategory
        ));
    }
}
