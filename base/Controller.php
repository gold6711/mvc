<?php
abstract class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $templatesRoot = 'views';
    protected $defaultLayout = 'main';

    protected $useLayout = true;
    /**
     * запуск контроллера
     */
    public function run(){
        if(is_null($this->action)){
            $this->action = $this->defaultAction;
        }

        $action = 'action' . ucfirst($this->action);
        if(method_exists($this, $action)){
            $this->beforeAction();
            $this->$action();
            $this->afterAction();
        }
    }

    public function beforeAction(){}
    
    public function afterAction(){}

    /**
     * отображение шаблона в одиночку или с использованием Layout
     * @param null $template
     * @param array $params
     */
    public function render($template = null,$params = []){
        if($this->useLayout){
            $content = $this->renderTemplate($template,$params);
            echo $this->renderTemplate(
                $this->defaultLayout,
                [
                    'title' => get_class($this),
                    'content' => $content
                ],
                true);
        }else{
            echo $this->renderTemplate($template,$params);
        }
    }

    /**
     * Вывод шаблона на экран
     * @param null $template
     * @param array $params
     * @param bool|false $isLayout
     * @return string
     */
    public function renderTemplate($template = null,$params = [], $isLayout = false){
        extract($params);
        ob_start();
        require $this->getTemplatePath($template,$isLayout);
        //require "{$this->templatesRoot}/{$sub}/{$template}";
        return ob_get_clean();
    }


    /**
     * Определение полного пути к шаблону
     * @param $template
     * @param bool|false $isLayout
     * @return string
     */
    protected function getTemplatePath($template,$isLayout = false){
        if($isLayout){
            return "{$this->templatesRoot}/layouts/{$template}.php";
        }else{
            if($template == null){
                $template = $this->action;
            }
            $sub = str_replace('Controller','',__CLASS__);
            return "{$this->templatesRoot}/{$template}.php";
        }
    }

    /**
     * action по умолчанию
    */
    public function actionIndex(){

    }

    /**
     * Устанавливаем  текущий action
     * @param mixed $action
     */
    public function setAction($action = null)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param bool $use
     */
    public function useLayout($use){
        $this->useLayout = $use;
    }

    public function redirect($url){
        header("Location: {$url}");
    }
}