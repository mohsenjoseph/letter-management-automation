<?php

class Logout extends Controller
{
	function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
        $chk=$this->model->logout();
        if(!$chk)
            $this->view('logout/index');
        else
            header('location:'.URL.'login');
    }

}