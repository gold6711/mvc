<?php
class AuthController extends Controller
{
    public function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
            $model = new Auth();
            if($model->login($_POST['login'],$_POST['pass'])){
               // $this->redirect("index.php?".session_name().'='.session_id());
                $this->redirect('index.php');
               // $this->render("logged");
                exit;
            }
        }
        $this->render("login");
    }

    public function actionLogin()
    {

    }

    public function actionLogout()
	{

    }

    public function check()
	{
		
	}
}