<?php
class Model
{
    public static $connect = '';
    public static $en=['0','1','2','3','4','5','6','7','8','9'];
    public static $fa=['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    public function __construct()
    {
        self::$connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASS);
        if (function_exists('jdate') == false) {
            require('public/jdf/jdf.php');
        }
    }
	public static function en2fa($txt){
		return str_replace(self::$en,self::$fa,(string)$txt);
	}
	public static function fa2en($txt){
		return str_replace(self::$fa,self::$en,(string)$txt);
	}
    public static function getoption()
    {
        $sql="select * from tbl_option";
        $stmt=self::$connect->prepare($sql);
        $stmt->execute();
        $options=$stmt->fetchAll();
        foreach($options as $option)
        {
            $setting=$option['setting'];
            $value=$option['value'];
            $options_new[$setting]=$value;
        }
        return $options_new;
    }
    public function doSelect($sql, $values = array(), $fetch = '', $fetchStyle = PDO::FETCH_ASSOC)
    {

        $stmt = self::$connect->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchStyle);
        } else {
            $result = $stmt->fetch($fetchStyle);
        }
        return $result;
    }
    public function doQuery($sql, $values = array())
    {

        $stmt = self::$connect->prepare($sql);

        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();

    }
    public static function checkUser()
    {
        if(isset($_COOKIE['userId']) && $_COOKIE['userId']!='')
        {
            if(isset($_COOKIE['session_login']) && $_COOKIE['session_login']!='') {
                self::$connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASS);
                $session_login = $_COOKIE['session_login'];
                $userId = $_COOKIE['userId'];
                $sql="select * from tbl_user where sessions=? and id=?";
                $result=Model::doSelect($sql,array($session_login,$userId),1);
                if($result['id']>0)
                    return 1;
                else
                    return 0;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public static function checkLevelUser($level)
    {
        if(isset($_COOKIE['userId']) && $_COOKIE['userId']!='')
        {
            if(isset($_COOKIE['session_login']) && $_COOKIE['session_login']!='') {
                self::$connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASS);
                $session_login = $_COOKIE['session_login'];
                $userId = $_COOKIE['userId'];
                $sql="select * from tbl_user where sessions=? and id=?";
                $result=Model::doSelect($sql,array($session_login,$userId),1);
                if($result['id'])
                {
                    $sql="select * from tbl_level where userId=? and id=?";
                    $result=Model::doSelect($sql,array($userId,$level),1);
                    if($result['id'])
                        return $level;
                    else
                        return 0;
                }
                else
                    return 0;
            }
            else
                return 0;
        }
        else
            return 0;
    }
    public static function changeNumber($text)
    {
        foreach(self::$en as $num) {
            $text = str_replace($num,self::en2fa($num) , $text);

        }
        return $text;
    }
    public static function jaliliDate($format = 'Y/n/j')
    {
        $date = jdate($format);
        return $date;
    }
    public static function jaliliToMiladi($jalili, $format = '/')
    {
        $jalili = explode($format, $jalili);
        $year = $jalili[0];
        $month = $jalili[1];
        $day = $jalili[2];
        $date = jalali_to_gregorian($year, $month, $day);
        $date = implode($format, $date);
        $date = new DateTime($date);
        $date = $date->format('Y'.$format.'m'.$format.'d');

        return $date;
    }
    public static function jaliliToMiladiTime($jalili, $format = '/')
    {
        $jalili = explode($format, $jalili);
        $year = $jalili[0];
        $month = $jalili[1];
        $day = $jalili[2];
        $date = jalali_to_gregorian($year, $month, $day);
        $date = implode($format, $date);
        $date = strtotime($date);
        return $date;
    }
    public static function MiladiTojalili($miladi, $format = '/')
    {
        $miladi = explode($format, $miladi);
        $year = $miladi[0];
        $month = $miladi[1];
        $day = $miladi[2];
        $date = gregorian_to_jalali($year, $month, $day);
        $date = self::changeNumber(implode($format, $date));
        return $date;
    }
    public function doReport($action_Id,$letter_Id='',$comment='',$userId='')
    {
        self::$connect = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $date_action= time();
        if($userId=='' && isset($_COOKIE['userId'])) $userId = $_COOKIE['userId'];
        $sql = "insert into tbl_report (action_id,letter_id,user_id,date_action,comment) values (?,?,?,?,?) ";
        Model::doQuery($sql, array($action_Id,$letter_Id,$userId,$date_action,$comment));
    }
}
?>