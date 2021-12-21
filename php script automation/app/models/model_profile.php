<?php

class model_profile extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function getUserFull()
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
    public function saveProfileEdit($ids)
    {
        $dt=time();
        $userpic='';
        $phone= $ids['phone'];
        $tell= $ids['tell'];
        $email= $ids['email'];
        $address= $ids['address'];
        $userId=$ids['userId'];
        if(strtolower($_FILES['userpic']['type']) != 'image/jpeg') return 'تصویر پروفایل باید با پسوند jpg باشد';
        $options = self::getoption();
        $file_upload_size = $options['file_upload_size'];
        $targetMain='public/uploads/'.$userId . '/';
        if(!file_exists($targetMain)) mkdir($targetMain, 0755);
        $uploadOkPic=0;
        if(isset($_FILES['userpic'])) {
            $file=$_FILES['userpic'];
            $fileNameUpload = 'profile_'.$dt.'.jpg';
            $fileSize = $file['size'];
            $fileTmp = $file['tmp_name'];
            $fileError = $file['error'];
            $uploadOkPic = 1;
            if ($fileSize > $file_upload_size) { $uploadOkPic = 0; }
            if ($fileError) {  $uploadOkPic = 0; }
            if ($uploadOkPic == 1) {
                $target = $targetMain . $fileNameUpload ;
                move_uploaded_file($fileTmp, $target);
            }
            $userpic=",userpic=".$dt;
        }

        if($userpic!='')
        {
            $sql = "update tbl_user  set phone=?,tell=?,email=?,address=?".$userpic." where id=?";
            $params=array($phone,$tell,$email,$address,$userId);
        }
        else
        {
            $sql = "update tbl_user  set phone=?,tell=?,email=?,address=? where id=?";
            $params=array($phone,$tell,$email,$address,$userId);
        }
        $this->doQuery($sql,$params);
        return 'ویرایش با موفقیت انجام شد';
    }
    function del_pic_profile($ids)
    {
        $userId = $ids['userId'];
        $sql = "select * from tbl_user where id=?";
        $params = array($userId);
        $user = self::doSelect($sql, $params, 1);
        $userpic = $user['userpic'];
        $urlFile = 'public/uploads/' . $userId . '/profile_'.$userpic.'.jpg';
        if (file_exists($urlFile)) {
            unlink($urlFile);

            $sql = "update tbl_user  set userpic='' where id=?";
            $params = array($userId);
            $this->doQuery($sql, $params);
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function saveProfilePassword($values)
    {
        if(isset($values['password'])&& $values['password']!='') {
            $password = sha1($values['password']);
            $userId = $values['userId'];

            $sql = "update tbl_user  set password=? where id=?";
            $params = array($password, $userId);
            $this->doQuery($sql, $params);
            return 'رمز عبور شما با موفقیت بروزرسانی شد';
        }
        else
            return 'رمز به درستی انتخاب نشده است';
    }
    public function getSetting()
    {
        $sql = "SELECT * FROM tbl_option";
        $setting = self::doSelect($sql);

        return $setting;
    }
    public function saveSetting($values)
    {
        $sql = "SELECT * FROM tbl_option";
        $setting = self::doSelect($sql);
        foreach($setting as $sets)
        {
            $id=$sets['id'];
            $value_params = $values[$sets['setting']];
            $sql="update tbl_option set value=?  where id=?";
            self::doQuery($sql,array($value_params,$id));
        }
        return 'بروزرسانی با موفقیت انجام شد';

    }
    public function save_pic_profile($ids)
    {
        $dt=time();
        $userpic='';
        $userId=$ids['userId'];
        if(strtolower($_FILES['userpic']['type']) != 'image/jpeg') return 'تصویر پروفایل باید با پسوند jpg باشد';
        $options = self::getoption();
        $file_upload_size = $options['file_upload_size'];
        $targetMain='public/uploads/'.$userId . '/';
        if(!file_exists($targetMain)) mkdir($targetMain, 0755);
        $uploadOkPic=0;
        if(isset($_FILES['userpic'])) {
            $file=$_FILES['userpic'];
            $fileNameUpload = 'profile_'.$dt.'.jpg';
            $fileSize = $file['size'];
            $fileTmp = $file['tmp_name'];
            $fileError = $file['error'];
            $uploadOkPic = 1;
            if ($fileSize > $file_upload_size) { $uploadOkPic = 0; }
            if ($fileError) {  $uploadOkPic = 0; }
            if ($uploadOkPic == 1) {
                $target = $targetMain . $fileNameUpload ;
                move_uploaded_file($fileTmp, $target);
            }
            $userpic=$dt;
        }

        if($uploadOkPic!='')
        {
            $pic['userId']=$userId;
            $this->del_pic_profile($pic);
            $sql = "update tbl_user  set userpic=? where id=?";
            $params=array($userpic,$userId);
            $this->doQuery($sql,$params);
        }
        return ;
    }
    function chk_pic_profile($ids)
    {
        sleep(1);
        $userId=$ids['userId'];
        $sql = "select * from tbl_user  where id=?";
        $params=array($userId);
        $user=$this->doSelect($sql,$params,1);
        return $user['userpic'];

    }
    public function getReport($page=0)
    {
        $paged_result='';$param='';$sqlPage='';$paramPage='';
        $page=intval($page);
        $options = self::getoption();
        $paged_item=$options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;

        $sql = "SELECT * FROM tbl_report  order by id DESC LIMIT $start, $paged_item";
        $report = self::doSelect($sql);
        foreach ($report as $key=>$row) {
            $sql = "SELECT * FROM tbl_user  WHERE id=?";
            $user = self::doSelect($sql, array($row['user_id']),1);
            $report[$key]['user_name'] = $user['name'];

            $sql = "SELECT * FROM tbl_action  WHERE id=? ";
            $action = self::doSelect($sql, array($row['action_id']),1);
            $report[$key]['action_type'] = $action['title'];

            $sql = "SELECT * FROM tbl_letter  WHERE id=? ";
            $letter = self::doSelect($sql, array($row['letter_id']),1);
            $report[$key]['letter_subject'] = $letter['subject'];
        }
        $sqlPage = "select count(id)  as ROWCOUNT FROM  tbl_report ";
        $rows = $this->doSelect($sqlPage,$paramPage,1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['report'=>$report,'paged_result'=>$paged_result];
    }
}