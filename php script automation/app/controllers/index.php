<?php

class Index extends Controller
{
	function __construct()
    {
        $chk=Model::checkUser();
        if($chk)
            header('location:'.URL.'letter');
        else
            header('location:'.URL.'login');
    }

    public function index()
	{
        $chk=Model::checkUser();
        if($chk)
            header('location:'.URL.'letter');
        else
            header('location:'.URL.'login');
    }

}