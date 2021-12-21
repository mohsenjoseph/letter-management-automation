<?php

class model_notepad extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    function getUserFull()
    {
        $id=$_COOKIE['userId'];
        $sql = "SELECT * FROM tbl_user WHERE id=?";  //user profile
        $param=array($id);
        $user = self::doSelect($sql,$param,1);

        $sql="SELECT * FROM tbl_level  WHERE userId=? order by parentId and status=1";
        $LevelInfo= self::doSelect($sql,array($id) );
        $user['levelInfo']=$LevelInfo;

        return $user;
    }
    function getPhones()
    {
        $userId=$_COOKIE['userId'];
        $sql = "SELECT * FROM tbl_phone WHERE userId=?";  //user profile
        $param=array($userId);
        $phone = self::doSelect($sql,$param);

        return $phone;
    }
    function getPhone($phoneId)
    {
        $sql = "SELECT * FROM tbl_phone WHERE id=?";  //user profile
        $param=array($phoneId);
        $phone = self::doSelect($sql,$param,1);

        return $phone;
    }
    function delete($ids)
    {
        foreach($ids as $id) {
            $sql = "delete from tbl_phone where id =?";
            $this->doQuery($sql,array($id));
        }
        return 'حذف با موفقیت انجام شد';
    }
    function addtell($ids)
    {
        //print_r($ids);
        $userId=$_COOKIE['userId'];
        if(isset($ids['phoneId'])) $phoneId=$ids['phoneId'];
        $message='در ثبت مخاطب جدید مشکلی بوجود آمده است';
        $name= $ids['name'];
        $mobile=  $ids['mobile'];
        $tell=  $ids['tell'];
        $email= $ids['email'];
        $adres= $ids['adres'];
        $description= $ids['description'];
        $work_company=  $ids['work_company'];
        $work_tell=  $ids['work_tell'];
        $work_email= $ids['work_email'];
        $work_fax= $ids['work_fax'];
        $work_website= $ids['work_website'];
        $work_adres= $ids['work_adres'];
        $params=[];
        if(isset($ids['insert']))
        {
            $sql = "insert into tbl_phone (work_company,work_tell,work_email,work_fax,work_website,work_adres,name,mobile,tell,email,adres,description,userId) value (?,?,?,?,?,?,?,?,?,?,?,?,?) ";
            $params=array($work_company,$work_tell,$work_email,$work_fax,$work_website,$work_adres,$name,$mobile,$tell,$email,$adres,$description,$userId);
            $message='مخاطب جدید با موفقیت اضافه شد';
        }
        elseif(isset($ids['edit']))
        {
            $sql = "update tbl_phone  set work_company=?,work_tell=?,work_email=?,work_fax=?,work_website=?,work_adres=?,name=?,mobile=?,tell=?,email=?,adres=?,description=? where id=?";
            $params = array($work_company,$work_tell,$work_email,$work_fax,$work_website,$work_adres,$name, $mobile, $tell, $email, $adres, $description, $phoneId);
            $message='بروزرسانی اطلاعات مخاطب با موفقیت انجام شد';
        }
        //print_r($params);
        $this->doQuery($sql,$params);
        return $message;
    }
    function getworks()
    {
        $userId=$_COOKIE['userId'];
        $sql = "SELECT * FROM tbl_work WHERE userId=?";
        $param=array($userId);
        $work = self::doSelect($sql,$param);
        foreach ($work as $key=>$row)
        {
            $work[$key]['date_end']=self::MiladiTojalili(date("Y/m/d",$row['date_end']));

        }
        return $work;
    }
    function getwork($workId)
    {
        $sql = "SELECT * FROM tbl_work WHERE id=?";  //user profile
        $param=array($workId);
        $work = self::doSelect($sql,$param,1);
        $work['date_end']=self::MiladiTojalili(date("Y/m/d",$work['date_end']));
        return $work;
    }
    function deletework($ids)
    {
        foreach($ids as $id) {
            $sql = "delete from tbl_work where id =?";
            $this->doQuery($sql,array($id));
        }
        return 'حذف با موفقیت انجام شد';
    }
    function addwork($ids)
    {
        $userId=$_COOKIE['userId'];
        if(isset($ids['workId'])) $workId=$ids['workId'];
        $message='در ثبت کاربر جدید مشکلی بوجود آمده است';
        $subject= $ids['subject'];
        $description=  $ids['description'];
        $date_end=  self::jaliliToMiladiTime($ids['date_end']);
        $status= $ids['status'];
        $params=[];
        if(isset($ids['insert']))
        {
            $sql = "insert into tbl_work (subject,description,date_end,status,userId) value (?,?,?,?,?) ";
            $params=array($subject,$description,$date_end,$status,$userId);
            $message='کار جدید با موفقیت اضافه شد';
        }
        elseif(isset($ids['edit']))
        {
            $sql = "update tbl_work  set subject=?,description=?,date_end=?,status=? where id=?";
            $params = array($subject, $description, $date_end, $status,  $workId);
            $message='بروزرسانی جزئیات کار با موفقیت انجام شد';
        }
        $this->doQuery($sql,$params);
        return $message;
    }
    function numWorkToday()
    {
        $userId=$_COOKIE['userId'];
        $sql="SELECT * from  tbl_work WHERE status<>5 and userId=?  ";
        $param=array($userId);
        $work= self::doSelect($sql,$param);
        $NumWork=0;
        $todayTime=time();
        $today=self::MiladiTojalili(date("Y/m/d",$todayTime));
        $date_endWork='';
        foreach ($work as $row)
        {
            $date_endWork=self::MiladiTojalili(date("Y/m/d",$row['date_end']));
            if($today==$date_endWork)$NumWork++;
        }
        return $NumWork;
    }

}