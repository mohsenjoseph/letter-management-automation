<?php

class model_secretariat extends Model
{

    public function __construct()
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


    public function getLetterRecive()
    {
        $options = self::getoption();
        $limit = $options['limit_row_view'];
        $sql="SELECT * FROM tbl_letter   WHERE archive=0  and status>=1 order by date_create DESC,numLetter DESC LIMIT ".$limit; //user letter recive
        $letters= self::doSelect($sql);
        foreach($letters as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $letters[$key]['level_sender']=$levelName;
            $letters[$key]['date_create']=date("Y-m-d",$row['date_create']);
        }
        return $letters;
    }

    public function getLetterSend()
    {
        $options = self::getoption();
        $limit = $options['limit_row_view'];

        $sql="SELECT * from  tbl_letter  WHERE archive=0 and status=2 and levelId_signature=0  order by date_create DESC,numLetter DESC LIMIT ".$limit; //user letter recive
        $lettersSend= self::doSelect($sql);

        foreach($lettersSend as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersSend[$key]['level_sender']=$levelName;
            $lettersSend[$key]['date_create']=date("Y-m-d",$row['date_create']);

        }

        return $lettersSend;
    }

    public function getLetter($letterId)
    {
        $sql = "SELECT * from  tbl_letter  WHERE id=? ";
        $letter = self::doSelect($sql, array($letterId), 1);
//////////////////////////   create
        $levelId=$letter['levelId_create'];
        $sql="SELECT * FROM tbl_level  WHERE id=? ";
        $level= self::doSelect($sql,array($levelId),1);
        $letter['create_semat']=$level['semat'];
        $userId=$level['userId'];
        $sql="SELECT * FROM tbl_user  WHERE id=? ";
        $user= self::doSelect($sql,array($userId),1);
        $letter['create_name']=$user['name'];
//////////////////////////   signature
        if(isset($letter['levelId_signature'])) {
            $levelId = $letter['levelId_signature'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? ";
            $level = self::doSelect($sql, array($levelId), 1);
            $letter['signature_semat'] = $level['semat'];
            $userId = $level['userId'];
            $sql = "SELECT * FROM tbl_user  WHERE id=? ";
            $user = self::doSelect($sql, array($userId), 1);
            $letter['signature_name'] = $user['name'];
            $letter['signature_userId'] = $user['id'];
        }
//////////////////////////   reciver
        if(isset($letter['levelId_Recive'])) {
            $levelId = $letter['levelId_Recive'];
            $userRecive = [];
            $levelRecive = explode(',', $levelId);
            $i = 0;
            foreach ($levelRecive as $key => $id) {
                $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                $level = self::doSelect($sql, array($id), 1);
                $userRecive[$i]['recive_semat'] = $level['semat'];
                $userId = $level['userId'];
                $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                $user = self::doSelect($sql, array($userId), 1);
                $userRecive[$i]['recive_name'] = $user['name'];
                $i++;
            }
            $letter['userRecive'] = array_filter($userRecive);
        }
//////////////////////////   recive_cc
        if(isset($letter['levelId_Cc'])) {
            $levelId = $letter['levelId_Cc'];
            $userCc = [];
            $levelCc = explode(',', $levelId);
            $i = 0;
            foreach ($levelCc as $key => $id) {
                $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                $level = self::doSelect($sql, array($id), 1);
                $userCc[$i]['cc_semat'] = $level['semat'];
                $userId = $level['userId'];
                $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                $user = self::doSelect($sql, array($userId), 1);
                $userCc[$i]['cc_name'] = $user['name'];
                $i++;
            }
            $letter['userCc'] = array_filter($userCc);
        }
//////////////////////////   attach file
        $fileState = $letter['file'];
        $file=[];
        if($fileState) {
            $sql="select * from tbl_file where date_create=? order by name_create";
            $file=self::doSelect($sql,array($letter['date_create']));
        }
        $letter['files']=array_filter($file);
//////////////////////////////
        $letter['date_numLetter']=date("Y-m-d",$letter['date_signature']);
////////////////////////////////
        return $letter;
    }

    public function getLevelSecretariatAvailable()
    {
        $userId=$_COOKIE['userId'];
        $sql="SELECT * FROM tbl_level  WHERE semat<>'دبیرخانه' ";
        $levelInfo= self::doSelect($sql,array($userId));
        foreach($levelInfo as $key=>$value)
        {
            if($value['userId']!='' || $value['userId']!=0)
            {
                $userId=$value['userId'];
                $sql="SELECT * FROM tbl_user  WHERE id=? ";
                $user= self::doSelect($sql,array($userId),1);
                $levelInfo[$key]['user_name']=$user['name'];
            }
        }
        return $levelInfo;
    }
    public function getReciveAvailable($levelId)
    {
        $sql="SELECT * FROM tbl_level  WHERE status=1 and id<>?";
        $levelInfo= self::doSelect($sql,array($levelId));
        foreach($levelInfo as $key=>$value)
        {
            if($value['userId']!='' || $value['userId']!=0)
            {
                $userId=$value['userId'];
                $sql="SELECT * FROM tbl_user  WHERE id=? ";
                $user= self::doSelect($sql,array($userId),1);
                $levelInfo[$key]['user']=$user;
            }
        }
        return $levelInfo;
    }


    public function letterSend($letter)
    {
        $subject=$textLetter=$description=$levelCreate=$levelSignature=$reciveId=$reciveCc=$fileName=$date_signature='';$status=0;
        if(isset($letter['level_create'])) {$levelCreate=$letter['level_create'];}
        if(isset($letter['signature'])) {$levelSignature=$letter['signature'];$status=1;$date_signature=time();}
        if(isset($letter['reciveId'])) {$reciveId=implode(',',$letter['reciveId']);}
        if(isset($letter['reciveCc'])) {$reciveCc=implode(',',$letter['reciveCc']);}
        if(isset($letter['subject'])) {$subject=$letter['subject'];}
        if(isset($letter['description'])) {$description=$letter['description'];}
        if(isset($letter['text_letter'])) {$textLetter=$letter['text_letter'];}
        $date_create=time();
        $msgUploadFile='';
        if(isset($_FILES['file'])) {
            $options = self::getoption();
            $file_upload_size = $options['file_upload_size'];
            $file=$_FILES['file'];
            $fileName = implode(',', $file['name']);
            $targetMain='public/uploads/letters/' . $date_create . '/';
            mkdir($targetMain, 0755);
            for($i=0 ; $i<sizeof($file['name']) ; $i++)
            {
                $fileNameUpload = $date_create.'-'.($i+1);
                $fileSize = $file['size'][$i];
                $fileTmp = $file['tmp_name'][$i];
                $fileError = $file['error'][$i];
                $uploadOk = 1;
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $extensionOK = array('jpg','jpeg','png','gif','pdf','doc','docx','xls','xls','ppt','ppts','pps','ppsx','rar','zip');
                $uploadOk = 1;
                if(!in_array($ext , $extensionOK)) {
                    $uploadOk = 0;
                    $msgUploadFile .=  "<br>نوع فایل ".$fileName.' متفاوت با نوع فایلهای مجاز می باشد';
                }

                if ($fileSize > $file_upload_size) { $uploadOk = 0; }
                if ($fileError) {  $uploadOk = 0; }
                if ($uploadOk == 1) {
//                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $target = $targetMain . $fileNameUpload . '.' . $ext;
                    move_uploaded_file($fileTmp, $target);
                }
            }
        }
        $params=array($subject,$textLetter,$description,$status,$date_create,$date_signature,'0',$levelCreate,$levelSignature,$reciveId,$reciveCc,$fileName);
        $sql="INSERT INTO tbl_letter(subject,text,description,status,date_create,date_signature,archive,levelId_create,levelId_signature,levelId_Recive,levelId_Cc,file) values (?,?,?,?,?,?,?,?,?,?,?,?)";
        self::doQuery($sql,$params);
        /////////////////////
        $sql="select id from tbl_letter where date_create=?";
        $letterInfo=self::doSelect($sql,array($date_create),1);
        $letterId=$letterInfo['id'];
        $this->addNumberLetter($letterId);
        ///////////////////////
        if(isset($letter['reciveId']))
        {
            foreach($letter['reciveId'] as $reciveId)
            {
                $sql="insert into tbl_letter_recive (letterId,levelId,recive_status,description,date_send) VALUES (?,?,?,?,?)";
                $params=array($letterId,$reciveId,2,$description,$date_create);
                self::doQuery($sql,$params);
            }
        }
        if(isset($letter['reciveCc']))
        {
            foreach($letter['reciveCc'] as $reciveId)
            {
                $sql="insert into tbl_letter_recive (letterId,levelId,recive_status,description,date_send) VALUES (?,?,?,?,?)";
                $params=array($letterId,$reciveId,2,$description,$date_create);
                self::doQuery($sql,$params);
            }
        }
        //////////////////////
        return 'نامه ثبت و ارسال شد';
    }

    public function showLetter($levelId,$letterId)
    {
        $sql="SELECT * from tbl_letter_recive where letterId=? and levelId=?";
        $letter = self::doSelect($sql,array($letterId,$levelId),1);
        if($letter['date_view']=='') {
            $sql = "update tbl_letter_recive set date_view=?,read_status=1 where letterId=? and levelId=?";
            $date_show = time();
            $params = array($date_show, $letterId, $levelId);
            self::doQuery($sql, $params);
        }
    }
    public function addNumberLetter($letterId)
    {
        $year=date("Y");
        //////////////////
        $sql="SELECT count(id) as ROW_COUNT from  tbl_letter where numLetter<>'' ";
        $row= self::doSelect($sql);
        $ROW_COUNT=$row[0]['ROW_COUNT']+1;
        ///////////////////////
        $options=self::getoption();
        $middleNumLetter=$options['middle_letter_number'];
        $numLetter=$ROW_COUNT."/".$middleNumLetter."/".$year;

        $sql="update tbl_letter set numLetter=?,status=2 where id=?";
        $params=array($numLetter,$letterId);
        self::doQuery($sql,$params);

        return 'شماره ثبت و نامه ارسال شد';
    }

    public function letterOnlySend($letterId,$levelForwardId)
    {
        $description=$levelIdRecive=$levelIdCc='';
        $sql="select * from tbl_letter where id=?";
        $letterInfo=self::doSelect($sql,array($letterId),1);
        $description=$letterInfo['description'];
        $recive_status='2';
        $date_send=time();
        if($letterInfo['levelId_Recive']!='') {
            $levelIdRecive=explode(',',$letterInfo['levelId_Recive']);
            foreach($levelIdRecive as $reciveId)
            {
                $sql="insert into tbl_letter_recive (letterId,levelId,forwardLevelId,recive_status,description,date_send) VALUES (?,?,?,?,?,?)";
                $params=array($letterId,$reciveId,$levelForwardId,$recive_status,$description,$date_send);
                self::doQuery($sql,$params);
            }
        }
        if($letterInfo['levelId_Cc']!='') {
            $levelIdCc=explode(',',$letterInfo['levelId_Cc']);
            foreach($levelIdCc as $CcId)
            {
                $sql="insert into tbl_letter_recive (letterId,levelId,forwardLevelId,recive_status,description,date_send) VALUES (?,?,?,?,?,?)";
                $params=array($letterId,$CcId,$levelForwardId,$recive_status,$description,$date_send);
                self::doQuery($sql,$params);
            }
        }

    }

    public function forwradType($letterId)
    {
        $signature='';
        $sql="select * from tbl_letter where id=? ";
        $letter=self::doSelect($sql,array($letterId),1);
        if($letter['status'] != 0 ) $signature= " where id<>1";
        $sql="SELECT * from  tbl_forward_type  ".$signature;
        $type= self::doSelect($sql);
        return $type;
    }

    public function saveFroward($values)
    {
        $status=0;
        $letterId = $values['letterId'];
        $forwardLevelId = $values['forwardId'];
        $description = $values['description'];
        $forwardType = $values['forwardType'];
        $reciveIds = $values['reciveId'];
        $date_send=time();
        foreach ($reciveIds as $levelId)
        {
            $sql = "INSERT INTO tbl_letter_recive (letterId,levelId,forwardLevelId,description,recive_status,date_send) VALUES (?,?,?,?,?,?)";
            $params= array($letterId,$levelId,$forwardLevelId,$description,$forwardType,$date_send);
            self::doQuery($sql,$params);
        }
        return 'ارجاع با موفقیت انجام شد';
    }
    public function printOption()
    {
        $sql="select * from tbl_option where setting LIKE '%_print_%'";
        $option = self::doSelect($sql);
        $optionPrint=[];
        foreach($option as $val)
        {
            $optionPrint[$val['setting']]=$val['value'];
        }
        return $optionPrint;
    }
}
?>