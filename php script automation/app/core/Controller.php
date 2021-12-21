<?php

class Controller
{
    public static $en=['0','1','2','3','4','5','6','7','8','9'];
    public static $fa=['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    public function __construct()
    {
    }
    public function model($model)
    {
       require_once 'app/models/model_'. $model . '.php';
       $classname = "model_".$model;
       $this->model= new $classname;//new $model($this->getDb());
    }

    public function view($view,$data=[])
    {

        require_once 'app/views/templates/head.php';
        require_once 'app/views/templates/header.php';
        require_once 'app/views/templates/sidebar.php';
        require_once 'app/views/'. $view . '.php';
        require_once 'app/views/templates/footer.php';
    }
    public function en2fa($txt){
        return str_replace(self::$en,self::$fa,(string)$txt);
    }
}


