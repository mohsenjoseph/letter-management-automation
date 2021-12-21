<?php

class model_logout extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
    }
    function logout()
    {
        $sql="update tbl_user SET sessions='' WHERE id=?";
        $userId = $_COOKIE['userId'];
        self::doReport(2,'','',$userId);
        $params=array($userId);
        $this->doQuery($sql,$params);
        setcookie('userId', null, -1, '/');
        setcookie('session_login', null, -1, '/');

        return 1;
    }

}


?>