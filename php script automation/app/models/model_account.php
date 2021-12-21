<?php

class model_account extends Model
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
    function getAllUserFull()
    {
        $sql = "SELECT * FROM tbl_user ";  //user profile
        $users = self::doSelect($sql);
        return $users;
    }
    function getUsers($userId='')
    {
        if($userId!='') {
            $sql = "select tbl_user.*,tbl_user_power.name  as powerTitle
        from tbl_user
        LEFT JOIN tbl_user_power ON tbl_user.power=tbl_user_power.id where tbl_user.id=?
        order by id desc ";
            $result = $this->doSelect($sql, array($userId),1);
        }else
        {
            $sql = "select tbl_user.*,tbl_user_power.name  as powerTitle
        from tbl_user
        LEFT JOIN tbl_user_power ON tbl_user.power=tbl_user_power.id 
        order by id desc ";
            $result = $this->doSelect($sql);

        }
        return $result;
    }
    function changelevel1($ids)
    {

        $ids = implode(',', $ids);
        $sql = "update tbl_user set  power=3 where id IN (". $ids. ") ";
        $this->doQuery($sql);

    }
    function changelevel2($ids)
    {

        $ids = implode(',', $ids);
        $sql = "update tbl_user set power=2 where id IN (". $ids. ") ";
        $this->doQuery($sql);

    }
    function changelevel3($ids)
    {

        $ids = implode(',', $ids);
        $sql = "update tbl_user set power=1 where id IN (". $ids. ") ";
        $this->doQuery($sql);
    }
    function delete($ids)
    {
        foreach($ids as $id) {
            $urlUserProfile = 'public/uploads/' . $id.'/profile.jpg' ;
            if(file_exists($urlUserProfile))  unlink($urlUserProfile);
            $urlUserSignature = 'public/uploads/' . $id .'/signature.jpg';
            if(file_exists($urlUserSignature))  unlink($urlUserSignature);
            $urlUserDir = 'public/uploads/' . $id ;
            if(file_exists($urlUserDir))  rmdir ($urlUserDir);
            $sql = "delete from tbl_user where id =?";
            $this->doQuery($sql,array($id));
        }
        return 'حذف با موفقیت انجام شد';
    }
    function adduser($ids)
    {
        if(isset($ids['userId'])) $userId=$ids['userId'];
        $signaturepic=$userpic=NULL;
        $dt=time();
        $message='در ثبت کاربر جدید مشکلی بوجود آمده است';
        $code= intval($ids['code']);
        $name= $ids['name'];
        $phone=  $ids['phone'];
        $tell=  $ids['tell'];
        $email= $ids['email'];
        $address= $ids['address'];
        $username= $ids['username'];
        $ipStatic= $ids['ipStatic'];
        $apiKey= $ids['apiKey'];
        $secretKey= $ids['secretKey'];
        if(isset($ids['password'])&& $ids['password']!='') $password= sha1($ids['password']);
        $powerUser= $ids['powerUser'];
        if(isset($ids['insert']))
        {
            if(isset($password)){
                $sql = "insert into tbl_user (code,name,phone,tell,email,address,username,password,power,ipStatic,apiKey,secretKey,dt) value (?,?,?,?,?,?,?,?,?,?,?,?,?) ";
                $params=array($code,$name,$phone,$tell,$email,$address,$username,$password,$powerUser,$ipStatic,$apiKey,$secretKey,$dt);
            }
            else
            {
                $sql = "insert into tbl_user (code,name,phone,tell,email,address,username,power,ipStatic,apiKey,secretKey,dt) value (?,?,?,?,?,?,?,?,?,?,?,?) ";
                $params=array($code,$name,$phone,$tell,$email,$address,$username,$powerUser,$ipStatic,$apiKey,$secretKey,$dt);
            }
            self::doQuery($sql,$params);
            $sql = "select id from tbl_user where dt=?";
            $params = array($dt);
            $user = self::doSelect($sql, $params, 1);
            $userId = $user['id'];
        }
        
        $options = self::getoption();
        $file_upload_size = $options['file_upload_size'];
        $targetMain='public/uploads/'.$userId . '/';
        if(!file_exists($targetMain)) mkdir($targetMain, 0755);
        $uploadOkSig=0;
        if($_FILES['signaturefile']['error']!=4) {
            if(strtolower($_FILES['signaturefile']['type']) != 'image/jpeg') return 'تصویر امضاء باید با پسوند jpg باشد';
            $file=$_FILES['signaturefile'];
            $fileNameUpload = 'signature_'.$dt.'.jpg';
            $fileSize = $file['size'];
            $fileTmp = $file['tmp_name'];
            $fileError = $file['error'];
            $uploadOkSig = 1;
            if ($fileSize > $file_upload_size) { $uploadOkSig = 0; }
            if ($fileError) {  $uploadOkSig = 0; }
            if ($uploadOkSig == 1) {
                $target = $targetMain . $fileNameUpload ;
                move_uploaded_file($fileTmp, $target);
                $signaturepic=",signaturepic=".$dt;
            }
        }
        $uploadOkPic=0;
        if($_FILES['userpic']['error']!=4) {
            if(strtolower($_FILES['userpic']['type']) != 'image/jpeg') return 'تصویر پروفایل باید با پسوند jpg باشد';
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
                $userpic=",userpic=".$dt;
            }
        }
        $params=[];
        if(isset($ids['insert'])) {
            $sql = "update tbl_user set tell=?".$signaturepic.$userpic."  where id=? ";
            $params=array($tell,$userId);
            $message='کاربر جدید با موفقیت اضافه شد';
        }
        elseif(isset($ids['edit'])) {
            if($uploadOkSig==1)
            {
                $ids['userId']=$userId;
                $this->del_signature($ids);
            }
            if($uploadOkPic==1)
            {
                $ids['userId']=$userId;
                $this->del_pic_profile($ids);
            }
            if(isset($password)) {
                $sql = "update tbl_user  set code=?,name=?,phone=?,tell=?,email=?,address=?,username=?,password=?,power=?,ipStatic=?,apiKey=?,secretKey=? ".$signaturepic.$userpic."  where id=?";
                $params = array($code, $name, $phone, $tell, $email, $address, $username, $password, $powerUser,$ipStatic,$apiKey,$secretKey, $userId);
            }
            else{
                $sql = "update tbl_user  set code=?,name=?,phone=?,tell=?,email=?,address=?,username=?,power=?,ipStatic=?,apiKey=?,secretKey=? ".$signaturepic.$userpic." where id=?";
                $params = array($code, $name, $phone, $tell, $email, $address, $username, $powerUser,$ipStatic,$apiKey,$secretKey, $userId);
            }
            $message='بروزرسانی اطلاعات کاربر با موفقیت انجام شد';

        }
        $this->doQuery($sql,$params);
        return $message;
    }
    function getLevels($levelId='')
    {
        $levels=[];
        if($levelId!='') {
            $sql = "select * from tbl_level where tbl_level.id=?  ";
            $levels = $this->doSelect($sql, array($levelId),1);
            $parentId = $levels['parentId'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? ";
            $LevelInfo = self::doSelect($sql, array($parentId), 1);
            if (isset($LevelInfo['semat'])) {
                $levels['info'] = $LevelInfo['semat'];
                //$levels['semattop'] = $LevelInfo['semattop'];
            }
            else
                $levels['info'] = 'ریشه اصلی';

            $userId = $levels['userId'];
            $sql = "SELECT * FROM tbl_user  WHERE id=? ";
            $userInfo = self::doSelect($sql, array($userId), 1);
            if (isset($userInfo['name']))
                $levels['userinfo'] = $userInfo['name'];
            else
                $levels['userinfo'] = 'اختصاص داده نشده';
        }
        else
        {
            $sql = "select * from tbl_level where parentId=0  order by id   ";
            $levels = $this->doSelect($sql);
            foreach($levels as $key=>$level) {
                $parentId = $level['parentId'];
                $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                $LevelInfo = self::doSelect($sql, array($parentId), 1);
                $levels[$key]['info']='';
                if (isset($LevelInfo['semat'])) {
                    $levels[$key]['info'] = $LevelInfo['semat'];
                }
                else
                    $levels[$key]['info'] = 'ریشه اصلی';

                $userId = $level['userId'];
                $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                $userInfo = self::doSelect($sql, array($userId), 1);
                if (isset($userInfo['name']))
                    $levels[$key]['userinfo'] = $userInfo['name'];
                else
                    $levels[$key]['userinfo'] = 'اختصاص داده نشده';
                $levels[$key]['parentstate']=0;
                $sql = "SELECT count(id) as row FROM tbl_level  WHERE parentId=? ";
                $levelstate = self::doSelect($sql, array($level['id']), 1);
                if($levelstate['row']>0) $levels[$key]['parentstate']=1;
            }
        }
        return $levels;
    }
    function getsubLevels($ids)
    {
        $levelId=$ids['levelId'];
        $sql = "select * from tbl_level where parentId=?  order by id   ";
        $levels = $this->doSelect($sql,array($levelId));
        foreach($levels as $key=>$level) {
            $parentId = $level['parentId'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? ";
            $LevelInfo = self::doSelect($sql, array($parentId), 1);
            $levels[$key]['info']='';
            if (isset($LevelInfo['semat'])) {
                $levels[$key]['info'] = $LevelInfo['semat'];
            }
            else
                $levels[$key]['info'] = 'ریشه اصلی';

            $userId = $level['userId'];
            $sql = "SELECT * FROM tbl_user  WHERE id=? ";
            $userInfo = self::doSelect($sql, array($userId), 1);
            if (isset($userInfo['name']))
                $levels[$key]['userinfo'] = $userInfo['name'];
            else
                $levels[$key]['userinfo'] = 'اختصاص داده نشده';
            $levels[$key]['parentstate']=0;
            $sql = "SELECT count(id) as row FROM tbl_level  WHERE parentId=? ";
            $levelstate = self::doSelect($sql, array($level['id']), 1);
            if($levelstate['row']>0) $levels[$key]['parentstate']=1;
        }
        return $levels;
    }
    function getLevelsOff($levelId='')
    {
        $levels=[];
        if($levelId!='') {
            $sql = "select * from tbl_level where tbl_level.id=?  ";
            $levels = $this->doSelect($sql, array($levelId),1);
            $parentId = $levels['parentId'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? ";
            $LevelInfo = self::doSelect($sql, array($parentId), 1);
            if (isset($LevelInfo['semat'])) {
                $levels['info'] = $LevelInfo['semat'];
                $levels['semattop'] = $LevelInfo['semattop'];
            }
            else
                $levels['info'] = 'ریشه اصلی';

            $userId = $levels['userId'];
            $sql = "SELECT * FROM tbl_user  WHERE id=? ";
            $userInfo = self::doSelect($sql, array($userId), 1);
            if (isset($userInfo['name']))
                $levels['userinfo'] = $userInfo['name'];
            else
                $levels['userinfo'] = 'اختصاص داده نشده';
        }
        else
        {
            $sql = "select * from tbl_level";
            $levels = $this->doSelect($sql);
            foreach($levels as $key=>$level) {
                $parentId = $level['parentId'];
                $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                $LevelInfo = self::doSelect($sql, array($parentId), 1);
                if (isset($LevelInfo['semat'])) {
                    $levels[$key]['info'] = $LevelInfo['semat'];
                    $levels[$key]['semattop'] = $LevelInfo['semattop'];
                }
                else
                    $levels[$key]['info'] = 'ریشه اصلی';

                $userId = $level['userId'];
                $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                $userInfo = self::doSelect($sql, array($userId), 1);
                if (isset($userInfo['name']))
                    $levels[$key]['userinfo'] = $userInfo['name'];
                else
                    $levels[$key]['userinfo'] = 'اختصاص داده نشده';
            }
        }
        return $levels;
    }
    function deleteLevel($ids)
    {
        $ids = implode(',', $ids);
        $sql = "delete from tbl_level where id IN (". $ids. ") ";
        $this->doQuery($sql);
    }
    function addLevel($ids)
    {
        $signature_status=0;
        $semat = $ids['semat'];
        $semattop = $ids['semattop'];
        if(isset($ids['signature_status']))$signature_status = 1;
        $parentId = intval($ids['parentId']);
        $params=[];
        if(isset($ids['insert'])) {
            $sql = "insert into tbl_level (semat,semattop,parentId,signature_status) value (?,?,?,?) ";
            $params = array($semat,$semattop,$parentId,$signature_status);
        }
        elseif(isset($ids['edit'])) {
            $levelId = $ids['levelId'];
            $sql = "update tbl_level  set semat=?,semattop=?,parentId=?,signature_status=? where id=?";
            $params = array($semat,$semattop,$parentId,$signature_status,$levelId);
        }
        $this->doQuery($sql,$params);
    }
    function editUserLevel($ids)
    {
        $params=[];
        if(isset($ids['edit'])) {
            $userId =  intval($ids['userId']);
            $levelId = intval($ids['levelId']);
            $sql = "update tbl_level  set userId=? where id=?";
            $params = array($userId,$levelId);
        }
        $this->doQuery($sql,$params);
    }
    function checkUsername($username)
    {
        if($username!='')
        {
            $sql='select * from tbl_user where username=?';
            $user=self::doSelect($sql,array($username),1);
            if(sizeof($user)==1) return 'ok';
            else return 'error';
        }
        return 'errorspace';
    }
    function getDabirkhone($dabirId='')
    {
        $dabirkhones=[];
        if($dabirId!='') {
            $sql = "select * from tbl_dabirkhone  where id=?  ";
            $dabirkhones = $this->doSelect($sql, array($dabirId),1);
        }
        else
        {
            $sql = "select * from tbl_dabirkhone ";
            $dabirkhones = $this->doSelect($sql);
            foreach($dabirkhones as $key=>$dabirkhone) {
                $levelId = $dabirkhone['levelId'];
                if($levelId!='') {
                    $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                    $LevelInfo = self::doSelect($sql, array($levelId), 1);
                    if (isset($LevelInfo['semat'])) {
                        $dabirkhones[$key]['info'] = $LevelInfo['semat'];
                    }
                }
                else
                {
                    $dabirkhones[$key]['info'] = 'اختصاص داده نشده';
                }
            }
        }
        return $dabirkhones;
    }
    function saveDabirkhone($ids)
    {
        $params=[];$middle_letter_in=$middel_letter_internal=$middle_letter_out=$startNumberLetter='';
        $name= $ids['name'];
        $levelId=$ids['levelId'];
        $middle_letter_in= $ids['middle_letter_in'];
        $middel_letter_internal= $ids['middel_letter_internal'];
        $middle_letter_out= $ids['middle_letter_out'];
        $startNumberLetter= $ids['startNumberLetter'];
        if(isset($ids['dabirId']))
        {
            $dabirId =  intval($ids['dabirId']);
            $sql = "update tbl_dabirkhone  set name=?,levelId=?,middel_letter_in=?,middel_letter_internal=?,middel_letter_out=?,startNumberLetter=? where id=?";
            $params = array($name,$levelId,$middle_letter_in,$middel_letter_internal,$middle_letter_out,$startNumberLetter,$dabirId);
        }
        else
        {
            $sql = "insert into tbl_dabirkhone  (name,levelId,middel_letter_in,middel_letter_internal,middel_letter_out,startNumberLetter) values (?,?,?,?,?,?)";
            $params = array($name,$levelId,$middle_letter_in,$middel_letter_internal,$middle_letter_out,$startNumberLetter);
        }
        $this->doQuery($sql,$params);
    }
    function deleteDabir($ids)
    {
        $ids = implode(',', $ids);
        $sql = "delete from tbl_dabirkhone where id IN (". $ids. ") ";
        $this->doQuery($sql);
    }
    function del_signature($ids)
    {
        $userId = $ids['userId'];
        $sql = "select * from tbl_user where id=?";
        $params = array($userId);
        $user = self::doSelect($sql, $params, 1);
        $signatuer = $user['signaturepic'];
        $urlFile = 'public/uploads/' . $userId . '/signature_'.$signatuer.'.jpg';
        if (file_exists($urlFile)) {
            unlink($urlFile);

            $sql = "update tbl_user  set signaturepic='' where id=?";
            $params = array($userId);
            $this->doQuery($sql, $params);
            return 1;
        }
        else
        {
            return 0;
        }
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

}