<?php
///////////////////////////    C_Base.php     ////////////////////////////////////
abstract class C_Base extends Controller
{
    protected $title;
    protected  $content;

    function __construct()
    {

    }

    protected function OnInput()
    {
        $this->title='Название сайта';
        $this->content='';
    }
    protected function OnOutput()
    {
        $vars = array('title'=>$this->title, 'content'=>$this->content);
        $page = $this->Template('theme/v_main.php', $vars);
        echo $page;
    }
}
///////////////////////////    index.php     /////////////////////////////////////////
include_once('inc/C_Edit.php');
include_once('inc/C_View');

switch($_GET['c'])
{
    case 'edit':
        $controller = new C_Edit();
        break;
    case 'delete':
        $controller = new C_Delete();
        break;
    default:
        $controller = new C_View();
}
$controller->Request();
//////////////////////////////   C_View.php   /////////////////////////////////////////
include_once('inc/C_Base.php');
include_once('inc/model.php');

class C_View extends C_Base
{
    private $text;
    function __construct()
    {
    }

    protected function OnInput()
    {
        parent ::OnInput();
        $this->title = $this->title . ' :: Читать статью';
        $this->text = text_get();
    }
    protected function OnOutput()
    {
        parent ::OnOutput();
        $vars = array('text' => $this->text);
        $this->content = $this->Template('theme/view.php', $vars);
    }
}
/////////////////////////////   C_Edit.php   //////////////////////////////////////////
include_once('inc/C_Base.php');
include_once('inc/model.php');

class C_Edit extends C_Base
{
    private $text;
    private $error;

    function __consruct()
    {
    }
    protected function OnInput()
    {
        parent ::OnInput();
        $this->title = $this->title . ' ::Редактирование';

        if($this->IsPost())
        {
            $text = $_POST['text'];
            if(strpos($text, '<') !== false)
            {
                $this->text = $text;
                $this->error = 'тект не должен содержать теги';
            }
            else
            {
                text_set($text);
                header('Location: index.php');
                die();
            }
        }
        else
        {
            $this->text = text_get();
        }
    }
    protected function OnOutput()
    {
        parent::OnOutput();
        $vars = array('text'=>$this->text, 'error'=>$this->error);
        $this->content = $this->Template('theme/v_edit.php', $vars);
    }
}
///////////////////    Controller.php     ////////////////////////////
abstract class Controler
{
    function __construct()
    {
    }
    public function Request()
    {
        $this->OnInput();
        $this->OnOutput();
    }
    protected function OnInput()
    {
    }
    protected function OnOutput()
    {
    }
    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] = 'GET';
    }
    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] = 'POST';
    }
    protected function Template($fileName ,$vars = array())
    {
        foreach($vars as $k=>$v)
        {
            $$k=$v;
        }
        ob_start();
        include $fileName;
        return ob_get_clean();
    }
}
////////////////////////  model.php  /////////////////
function text_get()
{
    file_get_contents('data/text.txt');
}
function text_set()
{
    file_put_contents('data/text.txt', $text);
}
///////////////////////////////////////////////////////////////////










