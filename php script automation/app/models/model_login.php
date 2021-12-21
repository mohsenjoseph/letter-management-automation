<?php

class model_login extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
    }
    function loginUser($form)
    {
        $options=parent::getoption();
        $timeLiveCookie = $options['time_live_cookie'];

        $username = addslashes(htmlentities($form['username']));
        $password = sha1 ($form['password']);
        $result='';
        $sql="select * from tbl_user where username=? and password=?";
        $params=array($username,$password);
        $result=$this->doSelect($sql,$params,1);
        if(sizeof($result)>1 and !empty($username) and !empty($password))
        {
            $time=time();
            $expire=$time+$timeLiveCookie;
            $session_login=rand(1000,9999).time().rand(1000,9999);
            setcookie ('userId', $result['id'],$expire,"/");
            setcookie ('session_login', $session_login,$expire,"/");
            $sql="update tbl_user  SET sessions=? where id=?";
            $params=array($session_login,$result['id']);
            $this->doQuery($sql,$params);
            self::doReport(1,'','', $result['id']);
            return true;
        }
        else
        {
            self::doReport(13,'','نام کاربری:'.$username);
            return false;
        }
    }
    /*public function saveAction($action_id,$comment,$userId=''){
        self::doReport($action_id,'',$comment,$userId);
    }*/
}


?>