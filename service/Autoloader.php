<?php
class Autoloader
{
    protected $root = '';
    protected $dirs = [
        'base/',
        'controllers/',
        'models/',
        'service/'
    ];

    /**
     * Autoloader constructor.
     */
    public function __construct()
    {
        spl_autoload_register([$this,'loadClass']);
    }

    public function loadClass($className){
        foreach($this->dirs as $dir){
            $filename = "{$this->root}{$dir}{$className}.php";
            if(file_exists($filename)){
                include $filename;
                break;
            }
        }
    }
}