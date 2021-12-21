<?php

class Login extends Controller
{
    function __construct()
    {
    }
    public function index()
    {
        $data = ['login'=>'login'];
        $this->view('login/index',$data);
    }

    public function checkuser()
    {
        $form = $_POST;
        $check=$this->model->loginUser($form);
        //echo $check;
        if(!$check){
            header('location:'.URL.'login');
        }
        else
        {
            header('location:'.URL.'letter');
        }
    }

}