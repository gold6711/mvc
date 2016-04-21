<?php
class ArticleController extends Controller
{

    public function actionIndex()
    {
       /* $model = new ArticleList(Db::getInstance());*/
        $model = new Article();
        //$this->renderTemplate('articleList',['articles' => $model::getAll()]);
        $this->render('articleList',['articles' => $model::getAll()]);
    }

    public function actionDisplay(){
        $id = $_GET['id'];
        $model = new Article(Db::getInstance());
        //var_dump($model->getById($id));
        //$this->renderTemplate('articleSingle',['article' => $model->getById($id)]);
        $model->getById($id);
        $this->render('articleSingle',['article' => $model->getById($id)]);
    }
}