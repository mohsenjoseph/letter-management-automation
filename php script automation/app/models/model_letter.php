<?php

class model_letter extends Model
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
        $user['levelInfo']=array_filter($LevelInfo);

        return $user;
    }
    public function getDabirAvailable($levelId='')
    {
        if($levelId=='') {
            $sql = "SELECT * FROM tbl_dabirkhone";
            $dabirkhones = self::doSelect($sql);
        }
        else{
            $sql = "SELECT * FROM tbl_dabirkhone where levelId=?";
            $dabirkhone = self::doSelect($sql,array($levelId),1);
            $dabirkhones=$dabirkhone['id'];
        }
        return $dabirkhones;
    }
    public function counterLetter($levelId)
    {
        $letterCount=[];
        $sumReciveUnRead=0;$sumDraft=0;$archiveUnread=0;

        $sql="SELECT count(id) as ROW_COUNT from  tbl_letter where tbl_letter.archive=0 and tbl_letter.status=0 and  tbl_letter.levelId_create=? "; //user letter recive
        $param=array($levelId);
        $row= self::doSelect($sql,$param,1);
        $sumDraft=$row['ROW_COUNT'];

        $sql="SELECT count(tbl_letter_recive.id) as ROW_COUNT from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE tbl_letter_recive.read_status=0 and tbl_letter_recive.archive=0 and tbl_letter_recive.levelId=?  "; //user letter recive
        $param=array($levelId);
        $row= self::doSelect($sql,$param,1);
        $sumReciveUnRead=$row['ROW_COUNT'];

        $sql="SELECT count(tbl_letter_recive.id) as ROW_COUNT from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE tbl_letter_recive.read_status=0 and tbl_letter_recive.archive=1 and tbl_letter_recive.levelId=?  "; //user letter recive
        $param=array($levelId);
        $row= self::doSelect($sql,$param,1);
        $archiveUnread=$row['ROW_COUNT'];

        $sql="SELECT count(tbl_letter.id) as ROW_COUNT from  tbl_letter WHERE tbl_letter.numLetter='' and tbl_letter.status=1  "; //user letter recive
        $param=array($levelId);
        $row= self::doSelect($sql,$param,1);
        $UnNumLetter=$row['ROW_COUNT'];

        $letterCount['ReciveUnRead']=$sumReciveUnRead;
        $letterCount['Draft']=$sumDraft;
        $letterCount['archiveUnread']=$archiveUnread;
        $letterCount['UnNumLetter']=$UnNumLetter;

        return $letterCount;

    }
    public function counterLetterRecive($levelId)
    {
        $sumReciveUnRead=0;
        $levelId=intval($levelId);
        $sql="SELECT count(tbl_letter_recive.id) as ROW_COUNT from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE tbl_letter_recive.read_status=0 and tbl_letter_recive.archive=0 and tbl_letter_recive.levelId=?  "; //user letter recive
        $param=array($levelId);
        $row= self::doSelect($sql,$param,1);
        $sumReciveUnRead=$row['ROW_COUNT'];
        return $sumReciveUnRead;

    }
    public function noNumberLetter($levelId)
    {
        $levelId=intval($levelId);
        $sql = "SELECT * FROM tbl_dabirkhone where levelId=?";
        $dabirkhone = self::doSelect($sql,array($levelId),1);
        $dabirId = $dabirkhone['id'];

        $sumNumberLetterSend='';
        $sumNumberLetterInternal='';

        $sql="SELECT count(id) as ROW_COUNT from  tbl_letter WHERE input=0 and status=1  and dabirId=?  ";
        $param=array($dabirId);
        $row= self::doSelect($sql,$param,1);
        $sumNumberLetterInternal=$row['ROW_COUNT'];

        $sql="SELECT count(id) as ROW_COUNT from  tbl_letter WHERE input=2 and status=1  and dabirId=?  ";
        $param=array($dabirId);
        $row= self::doSelect($sql,$param,1);
        $sumNumberLetterSend=$row['ROW_COUNT'];
        return ($sumNumberLetterInternal."||".$sumNumberLetterSend);
    }
    public function getLetterRecive($levelId,$itembox='',$page=0)
    {
        $paged_result='';$param='';$sqlPage='';$paramPage='';
        $page=intval($page);
        $options = self::getoption();
        $paged_item=$options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        $letters=[];
        if($itembox!='dabir') {
            $sql = "SELECT tbl_letter.*,tbl_letter_recive.read_status,tbl_letter_recive.archive,tbl_letter_recive.recive_status,tbl_letter_recive.id 
                      as tblLetterId   FROM tbl_letter INNER JOIN tbl_letter_recive ON tbl_letter.id=tbl_letter_recive.letterId  
                      WHERE tbl_letter_recive.archive=0 and tbl_letter_recive.levelId=? 
                      order by tbl_letter.date_create  DESC  LIMIT  $start, $paged_item"; //user letter recive
            $param = array($levelId);
            $letters = self::doSelect($sql, $param);
            foreach($letters as $key=>$row)  // nema_sender
            {
                $sql="SELECT * FROM tbl_level WHERE id=?";
                $param=array($row['levelId_create']);
                $levelSender= self::doSelect($sql,$param,1);
                $levelName=$levelSender['semat'];
                $letters[$key]['level_sender']=$levelName;
                /////////////////////////////
                $sql="SELECT * FROM tbl_forward_type WHERE id=?";
                $param=array($row['recive_status']);
                $levelForward= self::doSelect($sql,$param,1);
                $forwardName=$levelForward['name'];
                $letters[$key]['forwardName']=$forwardName;
                $letters[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
            }
            $sqlPage = "select count(tbl_letter.id)  as ROWCOUNT FROM tbl_letter INNER JOIN tbl_letter_recive ON tbl_letter.id=tbl_letter_recive.letterId  
                      WHERE tbl_letter_recive.archive=0 and tbl_letter_recive.levelId=? ";
            $paramPage=array($levelId);
        }
        else
        {
            $dabirId='';
            $sql= "select * from tbl_dabirkhone where levelId=?";
            $dabirkhone=self::doSelect($sql,array($levelId),1);
            $dabirId=$dabirkhone['id'];
            if($dabirId!='') {
                $sql = "SELECT * FROM tbl_letter   WHERE dabirId=? and status>=1 order by date_create DESC   LIMIT $start, $paged_item"; //user letter recive
                $letters = self::doSelect($sql,array($dabirId));
                foreach ($letters as $key => $row)  // nema_sender
                {
                    $sql = "SELECT * FROM tbl_level WHERE id=?";
                    $param = array($row['levelId_create']);
                    $levelSender = self::doSelect($sql, $param, 1);
                    $levelName = $levelSender['semat'];
                    $letters[$key]['level_sender'] = $levelName;
                    $letters[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
                }
                $sqlPage = "select count(id)  as ROWCOUNT FROM  tbl_letter WHERE dabirId=? and status>=1 ";
                $paramPage=array($dabirId);
            }
        }
        $rows = $this->doSelect($sqlPage,$paramPage,1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$letters,'paged_result'=>$paged_result];
    }
    public function getLetterSend($levelId,$itembox='',$page=0,$state='')
    {
        $paged_result='';$sqlPage='';$param='';
        $page=intval($page);
        $options = self::getoption();
        $paged_item=$options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        if($itembox!='dabir') {
            $sql = "SELECT * from  tbl_letter  WHERE archive=0 and status>=1 and levelId_create=? order by date_create DESC LIMIT $start, $paged_item" ; //user letter recive
            $paramPage = array($levelId);
            $lettersSend = self::doSelect($sql, $paramPage);
            $sqlPage="archive=0 and status>=1 and levelId_create=?";
        }
        else
        {
            $dabirId='';
            $sql= "select * from tbl_dabirkhone where levelId=? ";
            $dabirkhone=self::doSelect($sql,array($levelId),1);
            $dabirId=$dabirkhone['id'];
            if($dabirId!='') {
                if($state=='send')
                {
                    $sql = "SELECT * from  tbl_letter  WHERE dabirId=? and status>=1 and input=2   order by date_create DESC,numLetter DESC LIMIT $start, $paged_item"; //user letter recive
                    $paramPage=array($dabirId);
                    $lettersSend = self::doSelect($sql, $paramPage);
                    $sqlPage="dabirId=? and status>=1 and input=2 ";
                }
            }
        }
        foreach($lettersSend as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersSend[$key]['level_sender']=$levelName;
            $lettersSend[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
            $lettersSend[$key]['date_number_input']=$row['date_number_input'];
            $lettersSend[$key]['numLetter']=$row['numLetter'];
        }
        $sql = "select count(id)  as ROWCOUNT FROM  tbl_letter   WHERE  ".$sqlPage;
        $rows = $this->doSelect($sql,$paramPage,1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$lettersSend,'paged_result'=>$paged_result];
    }
    public function getLetterIntrnal($levelId,$itembox='',$page=0,$state='')
    {
        $paged_result='';$sqlPage='';$param='';
        $page=intval($page);
        $options = self::getoption();
        $paged_item=$options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        $dabirId='';
        $sql= "select * from tbl_dabirkhone where levelId=? ";
        $dabirkhone=self::doSelect($sql,array($levelId),1);
        $dabirId=$dabirkhone['id'];
        if($dabirId!='' && $itembox=='dabir')
        {
            if($state=='intrnal')
            {
                $sql = "SELECT * from  tbl_letter  WHERE dabirId=? and status>=1 and input=0   order by date_create DESC,numLetter DESC LIMIT $start, $paged_item"; //user letter recive
                $paramPage=array($dabirId);
                $lettersIntrnal = self::doSelect($sql, $paramPage);
                $sqlPage="dabirId=? and status>=1 and input=0 ";
            }
        }
        foreach($lettersIntrnal as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersIntrnal[$key]['level_sender']=$levelName;
            $lettersIntrnal[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
            $lettersIntrnal[$key]['date_number_input']=$row['date_number_input'];
            $lettersIntrnal[$key]['numLetter']=$row['numLetter'];
        }
        $sql = "select count(id)  as ROWCOUNT FROM  tbl_letter   WHERE  ".$sqlPage;
        $rows = $this->doSelect($sql,$paramPage,1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$lettersIntrnal,'paged_result'=>$paged_result];
    }
    public function getLetterInput($levelId,$itembox='',$page=0,$state='')
    {
        $lettersInput=[];
        $paged_result='';
        $page=intval($page);
        $options = self::getoption();
        $paged_item=$options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        $dabirId='';
        $sql= "select * from tbl_dabirkhone where levelId=? ";
        $dabirkhone=self::doSelect($sql,array($levelId),1);
        $dabirId=$dabirkhone['id'];
        if($dabirId!='') {
            $sql = "SELECT * from  tbl_letter  WHERE dabirId=? and input=1  order by date_create DESC,numLetter DESC LIMIT  $start, $paged_item"; //user letter recive
            $lettersInput = self::doSelect($sql, array($dabirId));
        }
        foreach($lettersInput as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersInput[$key]['level_sender']=$levelName;
            $lettersInput[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
            $lettersInput[$key]['date_number_input']=$row['date_number_input'];
            $lettersInput[$key]['numLetter']=$row['numLetter'];
        }
        $sql = "select count(id)  as ROWCOUNT FROM  tbl_letter   WHERE dabirId=? and input=1 ";
        $rows = $this->doSelect($sql,array($dabirId),1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$lettersInput,'paged_result'=>$paged_result];
    }
    public function getLetterDraft($levelId,$itembox='',$page=0)
    {
        $page=intval($page);
        $options = self::getoption();
        $paged_item = $options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        $sql="SELECT *  from  tbl_letter where archive=0 and status=0 and  levelId_create=?  order by date_create DESC LIMIT  $start, $paged_item"; //user letter recive
        $param=array($levelId);
        $lettersDraft= self::doSelect($sql,$param);

        foreach($lettersDraft as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersDraft[$key]['level_sender']=$levelName;
            $lettersDraft[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
        }
        $sql = "select count(id)  as ROWCOUNT FROM  tbl_letter   WHERE archive=0 and status=0 and levelId_create=? ";
        $rows = $this->doSelect($sql,array($levelId),1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$lettersDraft,'paged_result'=>$paged_result];
    }
    public function getLetterArchive($levelId,$itembox='',$page=0)
    {
        $page=intval($page);
        $options = self::getoption();
        $paged_item = $options['limit_row_view'];
        if($page==0) $page = 1;
        $start = ($page - 1) * $paged_item;
        $sql="SELECT tbl_letter.*,tbl_letter_recive.read_status,tbl_letter_recive.archive,tbl_letter_recive.recive_status,tbl_letter_recive.id 
                  as tblLetterId  from  tbl_letter left JOIN tbl_letter_recive 
                  on tbl_letter.id=tbl_letter_recive.letterId 
                  WHERE  tbl_letter_recive.archive=1 and tbl_letter_recive.levelId=? order by date_send DESC LIMIT $start, $paged_item"; //user letter recive
        $param=array($levelId);
        $lettersArchive= self::doSelect($sql,$param);

        foreach($lettersArchive as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $lettersArchive[$key]['level_sender']=$levelName;
            ///////////////////////////
            $sql="SELECT * FROM tbl_forward_type WHERE id=?";
            $param=array($row['recive_status']);
            $levelForward= self::doSelect($sql,$param,1);
            $forwardName=$levelForward['name'];
            $lettersArchive[$key]['forwardName']=$forwardName;
            $lettersArchive[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
        }
        $sql = "select count(tbl_letter.id)  as ROWCOUNT from  tbl_letter left JOIN tbl_letter_recive 
                  on tbl_letter.id=tbl_letter_recive.letterId 
                  WHERE  tbl_letter_recive.archive=1 and tbl_letter_recive.levelId=?";
        $rows = $this->doSelect($sql,array($levelId),1);
        $count=$rows['ROWCOUNT'];
        $paged_result=['count'=>$count,'paged_item'=>$paged_item,'page'=>$page];
        return ['letters'=>$lettersArchive,'paged_result'=>$paged_result];
    }
    public function getLetter($levelId='',$itemBox='',$letterId)
    {
        if($itemBox=='index') {
            $sql = "SELECT tbl_letter.*  from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE  tbl_letter_recive.archive=0 and tbl_letter_recive.letterId=? and tbl_letter_recive.levelId=?  ";
            $letter = self::doSelect($sql, array($letterId, $levelId), 1);
        }
        elseif($itemBox=='send') {
            $sql = "SELECT * from  tbl_letter  WHERE archive=0 and status>0 and id=? and levelId_create=?";
            $letter = self::doSelect($sql, array($letterId, $levelId), 1);
        }
        elseif($itemBox=='draft') {
            $sql = "SELECT *  from  tbl_letter where archive=0 and status<=1 and id=? and levelId_create=?  "; //user letter recive
            $letter = self::doSelect($sql, array($letterId, $levelId), 1);
        }
        elseif($itemBox=='archive') {
            $sql = "SELECT tbl_letter.* from  tbl_letter left JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE tbl_letter_recive.archive=1 and tbl_letter_recive.letterId=? and tbl_letter_recive.levelId=?  ";
            $letter = self::doSelect($sql, array($letterId, $levelId), 1);
        }
        elseif($itemBox=='dabir') {
            $sql = "SELECT * from  tbl_letter  WHERE id=? ";
            $letter = self::doSelect($sql, array($letterId), 1);
        }
//////////////////////////   create
        if($letter['status']>=1) {
            $letter['date_numLetter']=self::MiladiTojalili(date("Y/m/d",$letter['date_numLetter']));
//            $len=strlen($letter['date_numLetter']);
//            $letter['date_numLetter']=substr($letter['date_numLetter'],4,$len-4);
        }
        $letter['numLetter']=self::changeNumber($letter['numLetter']);
//////////////////////////////
        if($letter['levelId_create']) {
            $levelId = $letter['levelId_create'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? ";
            $level = self::doSelect($sql, array($levelId), 1);
            $letter['create_semat'] = $level['semat'];
            $userId = $level['userId'];
            $sql = "SELECT * FROM tbl_user  WHERE id=? ";
            $user = self::doSelect($sql, array($userId), 1);
            $letter['create_name'] = $user['name'];
            $letter['date_files']=$letter['date_create'];
            $letter['date_create']=self::MiladiTojalili(date("Y/m/d",$letter['date_create']));
        }
//////////////////////////   signature
        if(isset($letter['levelId_signature'])) {
            $levelId = $letter['levelId_signature'];
            $letter['signature_semat'] = '';
            $letter['signature_level'] = '';
            $letter['signature_name'] = '';
            $letter['signature_semattop'] = '';
            $letter['signature_userId'] = '';
            if ($levelId != '') {
                $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                $level = self::doSelect($sql, array($levelId), 1);
                $letter['signature_semat'] = $level['semat'];
                $letter['signature_semattop'] = $level['semattop'];
                $letter['signature_level'] = $level['id'];
                $userId = $level['userId'];
                $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                $user = self::doSelect($sql, array($userId), 1);
                $letter['signature_name'] = $user['name'];
                $letter['signature_userId'] = $user['id'];
                $letter['signaturepic'] = $user['signaturepic'];

            }
        }//////////////////////////   reciver
        if(isset($letter['levelId_Recive'])) {
            $levelId_Recive = $letter['levelId_Recive'];
            $userRecive = [];
            if ($levelId_Recive != '') {
                $levelRecive = explode(',', $levelId_Recive);
                $i = 0;
                foreach ($levelRecive as $key => $id) {
                    $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                    $level = self::doSelect($sql, array($id), 1);
                    if(isset($level['semat'])) {
                        $userRecive[$i]['recive_semat'] = $level['semat'];
                        $userRecive[$i]['recive_semattop'] = $level['semattop'];
                        $userRecive[$i]['recive_level'] = $level['id'];
                        $userId = $level['userId'];
                        $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                        $user = self::doSelect($sql, array($userId), 1);
                        $userRecive[$i]['recive_name'] = $user['name'];
                    }
                    else
                        $userRecive[$i]['recive_name'] = $id;

                    $i++;
                }
            }
            $letter['userRecive'] = array_filter($userRecive);
        }//////////////////////////   recive_cc
        if(isset($letter['levelId_Cc'])) {
            $levelId_Cc = $letter['levelId_Cc'];
            $userCc = [];
            if ($levelId_Cc != '') {
                $levelCc = explode(',', $levelId_Cc);
                $i = 0;
                foreach ($levelCc as $key => $id) {
                    $sql = "SELECT * FROM tbl_level  WHERE id=? ";
                    $level = self::doSelect($sql, array($id), 1);
                    if(isset($level['semat'])) {
                        $userCc[$i]['cc_semat'] = $level['semat'];
                        $userCc[$i]['cc_semattop'] = $level['semattop'];
                        $userCc[$i]['cc_level'] = $level['id'];
                        $userId = $level['userId'];
                        $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                        $user = self::doSelect($sql, array($userId), 1);
                        $userCc[$i]['cc_name'] = $user['name'];
                    }
                    else
                        $userCc[$i]['cc_name'] = $id;
                    $i++;
                }
            }
            $letter['userCc'] = array_filter($userCc);
        }//////////////////////////////   attach file
        $fileState = $letter['file'];
        $file=[];
        if($fileState) {
            $sql="select * from tbl_file where date_create=? order by name_create";
            $file=self::doSelect($sql,array($letter['date_files']));
        }
        $letter['files']=array_filter($file);

        $letter['text']=self::changeNumber($letter['text']);
        return $letter;
    }
    public function getLetterSearch($levelId='',$itemBox='',$searchParam='')
    {
        $type = $searchParam['type-search'];
        $text = $searchParam['search'];
        $task='';
        switch ($type){
            case 'numLetter' :
                $task='  and tbl_letter.numLetter like "%'.$text.'%"';
                break;
            case 'subject' :
                $task='  and tbl_letter.subject like "%'.$text.'%"';
                break;
            case 'text' :
                $task='  and tbl_letter.text like "%'.$text.'%"';
                break;
            case 'levelId_create' :
                $sql='select tbl_level.id from tbl_user INNER JOIN tbl_level on tbl_user.id=tbl_level.userId WHERE tbl_user.name like "%'.$text.'%" or  tbl_level.semat like "%'.$text.'%"';
                $level=self::doSelect($sql);
                $task.=' and (';
                $i=1;
                foreach ($level as $id)
                {
                    if($i!=1)$task.=' or ';
                    $task.=' tbl_letter.levelId_create='.$id['id'];
                    $i++;
                }
                $task.=')';
                break;
            case 'levelId_signature' :
                $sql='select tbl_level.id from tbl_user INNER JOIN tbl_level on tbl_user.id=tbl_level.userId WHERE tbl_user.name like "%'.$text.'%" or  tbl_level.semat like "%'.$text.'%"';
                $level=self::doSelect($sql);
                foreach ($level as $id)
                {
                    $task.='  or tbl_letter.levelId_signature='.$id;
                }
                break;
        }
        $letter=[];
        if($itemBox=='index') {
            $sql = "SELECT tbl_letter.*,tbl_letter_recive.*  from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE  tbl_letter_recive.archive=0 and tbl_letter_recive.levelId=? ".$task;
        }
        elseif($itemBox=='send') {
            $sql = "SELECT tbl_letter.* from  tbl_letter  WHERE archive=0 and status>0 and levelId_create=? ".$task;
        }
        elseif($itemBox=='draft') {
            $sql = "SELECT tbl_letter.*  from  tbl_letter  where archive=0 and status<=1 and levelId_create=? ".$task;
        }
        elseif($itemBox=='archive') {
            $sql = "SELECT tbl_letter.*,tbl_letter_recive.* from  tbl_letter INNER JOIN tbl_letter_recive on tbl_letter.id=tbl_letter_recive.letterId WHERE tbl_letter_recive.archive=1 and tbl_letter_recive.levelId=?  ".$task;
        }
        elseif($itemBox=='dabir') {
            $sql = "SELECT * from  tbl_letter  WHERE id=? ".$task;
        }
        $letters = self::doSelect($sql, array($levelId));
//////////////////////////   create
        foreach($letters as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $letters[$key]['level_sender']=$levelName;
            $letters[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));

            ///////////////////////////
            if($itemBox=='index' || $itemBox=='archive') {
                $sql = "SELECT * FROM tbl_forward_type WHERE id=?";
                $param = array($row['recive_status']);
                $levelForward = self::doSelect($sql, $param, 1);
                $forwardName = $levelForward['name'];
                $letters[$key]['forwardName'] = $forwardName;
            }
        }
        return $letters;
    }
    public function getLetterSearchDabir($levelId='',$itemBox='',$searchParam='')
    {
        $year = self::MiladiTojalili(date("Y"));
        $sql = "SELECT * FROM tbl_dabirkhone where levelId=?";
        $dabirkhone = self::doSelect($sql,array($levelId),1);
        $middleNumLetter = $dabirkhone['middel_letter_in'];
        $dabirId = $dabirkhone['id'];
        ///////////////////////////////
        $type = $searchParam['type-search'];
        $text = addslashes($searchParam['search']);
        $task='';
        switch ($type){
            case 'numLetter' :
                $task='  and tbl_letter.numLetter like "%'.$text.'%"  and tbl_letter.dabirId='.$dabirId;
                break;
            case 'numLetterIn' :
                $task='  and tbl_letter.date_number_input like "%'.$text.'%" and tbl_letter.dabirId='.$dabirId;
                break;
            case 'subject' :
                $task='  and tbl_letter.subject like "%'.$text.'%" and tbl_letter.dabirId='.$dabirId;
                break;
            case 'text' :
                $task='  and tbl_letter.text like "%'.$text.'%" and tbl_letter.dabirId='.$dabirId;
                break;
            case 'levelId_create' :
                $sql='select tbl_level.id from tbl_user INNER JOIN tbl_level on tbl_user.id=tbl_level.userId WHERE tbl_user.name like "%'.$text.'%" or  tbl_level.semat like "%'.$text.'%"';
                $level=self::doSelect($sql);
                $task.=' and (';
                $i=1;
                foreach ($level as $id)
                {
                    if($i!=1)$task.=' or ';
                    $task.=' tbl_letter.levelId_create='.$id['id'];
                    $i++;
                }
                $task.=') and tbl_letter.dabirId='.$dabirId;
                break;
            case 'levelId_signature' :
                $sql='select tbl_level.id from tbl_user INNER JOIN tbl_level on tbl_user.id=tbl_level.userId WHERE tbl_user.name like "%'.$text.'%" or  tbl_level.semat like "%'.$text.'%"';
                $level=self::doSelect($sql);
                foreach ($level as $id)
                {
                    $task.='  or tbl_letter.levelId_signature='.$id.' and tbl_letter.dabirId='.$dabirId;
                }
                break;
        }
        $letter=[];
        if($itemBox=='index') {
            $sql = "SELECT *  from  tbl_letter where status>0  ".$task;
        }
        elseif($itemBox=='send') {
            $sql = "SELECT tbl_letter.* from  tbl_letter  WHERE status>0  ".$task;
        }
        $letters = self::doSelect($sql, array($levelId));
//////////////////////////   create
        foreach($letters as $key=>$row)  // nema_sender
        {
            $sql="SELECT * FROM tbl_level WHERE id=?";
            $param=array($row['levelId_create']);
            $levelSender= self::doSelect($sql,$param,1);
            $levelName=$levelSender['semat'];
            $letters[$key]['level_sender']=$levelName;
            $letters[$key]['date_create']=self::MiladiTojalili(date("Y/m/d",$row['date_create']));
        }

        return $letters;
    }
    public function infoLevel($levelId , $letterId='' , $sender='')
    {
        $levelinfo=[];
        $sql = "SELECT * FROM tbl_level  WHERE id=? ";
        $level = self::doSelect($sql, array($levelId), 1);
        $levelinfo['semat'] = $level['semat'];
        $levelinfo['level'] = $level['id'];
        $userId = $level['userId'];
        ///////////////////////////////////////
        if($letterId!='') {
            $sql = "SELECT * FROM tbl_letter_recive  WHERE levelId=? and letterId=? and forwardLevelId=?";
            $params=array($level['id'], $letterId, $sender);
            $letterState = self::doSelect($sql, $params, 1);
            $levelinfo['read_status'] = $letterState['read_status'];
            $levelinfo['date_view'] =self::changeNumber(date("H:i:s",$letterState['date_view']))." ".self::MiladiTojalili( date("Y/m/d",$letterState['date_view']));
        }
        ////////////////////////////////////////////////////
        $sql = "SELECT * FROM tbl_user  WHERE id=? ";
        $user = self::doSelect($sql, array($userId), 1);
        $levelinfo['name'] = $user['name'];
        $levelinfo['userId'] = $user['id'];
        $levelinfo['signaturepic'] = $user['signaturepic'];
        return $levelinfo;
    }
    public function getForwardType($forwardId)
    {
        $sql = "SELECT * from  tbl_forward_type WHERE  id=?   ";
        $forward = self::doSelect($sql, array($forwardId),1);
        return $forward['name'];
    }
    public function getCycleLetter($levelId='',$itemBox='',$letterId)
    {
//////////////// start letter
        $letterCycle=[];
        $sql = "SELECT * from  tbl_letter WHERE  id=?   ";
        $letter = self::doSelect($sql, array($letterId),1);
        $letterCycle['subject'] = $letter['subject'];
        $levelId_create=$letter['levelId_create'];
        $letterCycle['input']=$letter['input'];
        $letterCycle['date_signature']='';
        if($letter['date_signature']!=0)
            $letterCycle['date_signature'] =self::changeNumber(date("H:i:s",$letter['date_signature']))." ".self::MiladiTojalili( date("Y/m/d",$letter['date_signature']));
        $letterCycle['date_create'] = self::changeNumber(date("H:i:s",$letter['date_create']))." ".self::MiladiTojalili(date("Y/m/d",$letter['date_create']));
        if($letter['levelId_create']) { $letterCycle['level_create'] = $this->infoLevel($letter['levelId_create']); } ////   create
        if($letter['levelId_signature']) { $letterCycle['level_signature'] =$this->infoLevel($letter['levelId_signature']); } ////   signature
        //////////////////////////   reciver
        if(isset($letter['levelId_Recive'])) {
            $levelId_Recive = $letter['levelId_Recive'];
            $userRecive = [];
            if ($levelId_Recive != '') {
                $levelRecive = array_filter(explode(',', $levelId_Recive));
                $i = 0;
                foreach ($levelRecive as $key => $id) {
                    $userRecive[$i]=$this->infoLevel($id,$letterId,$levelId_create);
                    $userRecive[$i]['forwardName']=$this->getForwardType('2');
                    $i++;
                }
            }
            $letterCycle['userRecive'] = array_filter($userRecive);
        }
        //////////////////////////   recive_cc
        if(isset($letter['levelId_Cc'])) {
            $levelId_Cc = $letter['levelId_Cc'];
            $userCc = [];
            if ($levelId_Cc != '') {
                $levelCc =array_filter(explode(',', $levelId_Cc));
                $i = 0;
                foreach ($levelCc as $key => $id) {
                    $userCc[$i]=$this->infoLevel($id,$letterId,$levelId_create);
                    $userCc[$i]['forwardName']=$this->getForwardType('2');
                    $i++;
                }
            }
            $letterCycle['userCc'] = array_filter($userCc);
        }
        ////////////////////////////// end letter
        //////////////////////////// start recive letter
        $sql = "SELECT *  from  tbl_letter_recive WHERE  letterId=? order by date_send   ";
        $reciveletter = self::doSelect($sql, array($letterId));
        foreach ($reciveletter as $key=>$row) {
            $reciveletter[$key]['recive'] = $this->infoLevel($row['levelId']);
            $reciveletter[$key]['sender'] = $this->infoLevel($row['forwardLevelId']);
            $reciveletter[$key]['date_send'] = date("H:i:s",$row['date_send'])." ".self::MiladiTojalili(date("Y/m/d",$row['date_send']));
            $reciveletter[$key]['answer'] = $row['answer'];
            $reciveletter[$key]['date_answer'] = date("H:i:s",$row['date_answer'])." ".self::MiladiTojalili(date("Y/m/d",$row['date_answer']));
            $reciveletter[$key]['date_view'] = date("H:i:s",$row['date_view'])." ".self::MiladiTojalili(date("Y/m/d",$row['date_view']));
            $reciveletter[$key]['forwardName'] = $this->getForwardType($row['recive_status']);
            $reciveletter[$key]['description'] = $row['description'];
        }
        ////////////////////////// end recive letter
        return [$letterCycle,$reciveletter];
    }
    public function getLevelSecretariatAvailable()
    {
        $sql="SELECT * FROM tbl_level  WHERE semat<>'دبیرخانه' and userId<>'' and userId<>0 ";
        $levelInfo= self::doSelect($sql);
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
        print_r($levelInfo);
    }
    public function getLevelAvailable()
    {
        $sql="SELECT * FROM tbl_level  WHERE signature_status=1 and userId<>0";
        $levelInfo= self::doSelect($sql);

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
        $levelInfo = array_filter($levelInfo);
        return $levelInfo;
    }
    public function getReciveAvailable()
    {
        $sql="SELECT * FROM tbl_level  WHERE status=1  and userId<>0 and userId<>''";
        $levelInfo= self::doSelect($sql);
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
    public function letterDraft($letter,$edit='')
    {
        $chkedit=0;$letterId='';$date_create = time();
        if(isset($letter['letterId'])) {
            $letterId = $letter['letterId'];
            $sql = "SELECT * from tbl_letter where id=?";
            $chks = self::doSelect($sql, array($letterId), 1);
            if($chks['numLetter']!='' && $chks['date_numLetter']!='') $chkedit=1;
            if($chks['id']!='') $date_create=$chks['date_create'];
        }
        if($chkedit==0) {
            $dabirId = $subject = $textLetter = $description = $levelCreate = $levelSignature = $reciveId = $reciveCc = $fileName = $date_signature = NULL;
            $status = 0;
            $old = 0;
            $fileUpload = 0;

            if (isset($letter['level_create'])) {
                $levelCreate = $letter['level_create'];
            }
            if (isset($letter['signature'])) {
                $levelSignature = $letter['signature'];
                $status = 0;
            }
            if (isset($letter['date_signature']) && $letter['date_signature'] != '') {
                $date_signature = time();
                $status = 1;
            }
            if (isset($letter['reciveId'])) {
                $reciveId = implode(',', $letter['reciveId']);
            }
            if (isset($letter['reciveCc'])) {
                $reciveCc = implode(',', $letter['reciveCc']);
            }
            if (isset($letter['subject'])) {
                $subject = $letter['subject'];
            }
            if (isset($letter['description'])) {
                $description = $letter['description'];
            }
            if (isset($letter['dabirkhone'])) {
                $dabirId = $letter['dabirkhone'];
            }
            if (isset($letter['text_letter'])) {
                $textLetter = $letter['text_letter'];
            }
            if (isset($letter['date_create'])) {
                $date_create = $letter['date_create'];
            }
            if (isset($letter['print_size'])) {
                $print_size = $letter['print_size'];
            }
            if (isset($letter['fileold'])) {
                $sql = 'select * from tbl_file where date_create=? order by name_create';
                $files = self::doSelect($sql, array($date_create));
                $old = sizeof($files);
                foreach ($files as $key => $file) {
                    foreach ($letter['fileold'] as $fileId) {
                        if ($file['id'] == $fileId) {
                            $files[$key]['del'] = 1;
                        }
                    }
                }
                foreach ($files as $file) {
                    if (!isset($file['del'])) {
                        $sql = 'delete from tbl_file where id=?';
                        self::doQuery($sql, array($file['id']));
                        $urlFile = 'public/uploads/letters/' . $date_create . '/' . $file['name_create'];
                        unlink($urlFile);
                    }
                    $olds = explode('-', $file['name_create']);
                    $olds = explode('.', $olds[1]);
                    $old = $olds[0];
                }
            }
            if ($old > 0) $fileUpload = 1;
            $old++;
            $msgUploadFile = '';
            if (isset($_FILES['file'])) {
                $options = self::getoption();
                $file_upload_size = $options['file_upload_size'];
                $file = $_FILES['file'];
                $targetMain = 'public/uploads/letters/' . $date_create . '/';
                if ($edit != 'edit' && $edit == '' || !file_exists($targetMain)) mkdir($targetMain, 0755);
                for ($i = 0; $i < sizeof($file['name']); $i++) {
                    $fileNameUpload = $date_create . '-' . $old;
                    $fileName = $file['name'][$i];
                    $fileSize = $file['size'][$i];
                    $fileTmp = $file['tmp_name'][$i];
                    $fileError = $file['error'][$i];
                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $extensionOK = array('jpg','jpeg','png','gif','pdf','doc','docx','xls','xls','ppt','ppts','pps','ppsx','rar','zip');
                    $uploadOk = 1;
                    if(!in_array($ext , $extensionOK)) {
                        $uploadOk = 0;
                        $msgUploadFile .=  "<br>نوع فایل ".$fileName.' متفاوت با نوع فایلهای مجاز می باشد';
                    }
                    if ($fileSize > $file_upload_size) {
                        $uploadOk = 0;
                    }
                    if ($fileError) {
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 1) {
//                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nameCreate = $fileNameUpload . '.' . $ext;
                        $target = $targetMain . $fileNameUpload . '.' . $ext;
                        move_uploaded_file($fileTmp, $target);
                        $sql = 'insert into tbl_file (name,date_create,name_create) values(?,?,?)';
                        self::doQuery($sql, array($fileName, $date_create, $nameCreate));
                        $fileUpload = 1;
                    }
                    $old++;
                }
            }
            if ($edit != 'edit' and $edit == '') {
                $params = array($dabirId, $print_size, $subject, $textLetter, $description, $status, $date_create, $date_signature, '0', $levelCreate, $levelSignature, $reciveId, $reciveCc, $fileUpload);
                $sql = "INSERT INTO tbl_letter(dabirId,print_size,subject,text,description,status,date_create,date_signature,archive,levelId_create,levelId_signature,levelId_Recive,levelId_Cc,file) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                self::doQuery($sql, $params);
            } elseif ($edit == 'edit') {
                $letterId = $letter['letterId'];
                $params = array($dabirId, $print_size, $subject, $textLetter, $description, $status, $date_create, $date_signature, '0', $levelSignature, $reciveId, $reciveCc, $fileUpload, $letterId);
                $sql = "UPDATE tbl_letter SET dabirId=?,print_size=?,subject=?,text=?,description=?,status=?,date_create=?,date_signature=?,archive=?,levelId_signature=?,levelId_Recive=?,levelId_Cc=?,file=? WHERE id=?";
                self::doQuery($sql, $params);
            }
            self::doReport(3,$letterId,$subject);
            if($msgUploadFile != '') $msgUploadFile .= '<br>پسوندهای مجاز: '. implode(", ",$extensionOK);
            return 'نامه شما بصورت پیش نویس ذخیره شد'.$msgUploadFile;
        }
        elseif($chkedit==1)
        {
            return 'نامه قابل ویرایش نمی باشد.شماره نامه قبلا ثبت شده است!!';
        }
    }
    public function letterSend($letter,$state='',$edit='')
    {
        $chkedit=0;$date_create = time();
        if(isset($letter['letterId'])) {
            $letterId = $letter['letterId'];
            $sql = "SELECT * from tbl_letter where id=?";
            $chks = self::doSelect($sql, array($letterId), 1);
            if($chks['numLetter']!='' && $chks['date_numLetter']!='') $chkedit=1;
            if($chks['id']!='') $date_create=$chks['date_create'];
        }
        if($chkedit==0) {
            $levelActive = '';
            $subject = $textLetter = $description = $levelCreate = $levelSignature = $reciveId = $reciveCc = $fileName = $date_signature = '';
            $status = 0;
            $old = 0;
            $fileUpload = 0;
            $status_save = 0;
            if (isset($letter['levelActive'])) {
                $levelActive = $letter['levelActive'];
            }
            if (isset($letter['level_create'])) {
                $levelCreate = $letter['level_create'];
            }
            if (isset($letter['signature'])) {
                $levelSignature = $letter['signature'];
                $status = 0;
            }
            if (isset($letter['date_signature']) && $letter['date_signature'] != '') {
                $date_signature = time();
                $status = 1;
            }
            $input = 0;
            if (isset($letter['reciveId'])) {
                foreach ($letter['reciveId'] as $recive) {
                    if (intval($recive) < 1) $input = 2;
                }
                $reciveId = implode(',', $letter['reciveId']);
            }
            if (isset($letter['reciveCc'])) {
               /* foreach ($letter['reciveCc'] as $reciveCc) {
                    if (intval($reciveCc) < 1) $input = 2;
                }*/
                $reciveCc = implode(',', $letter['reciveCc']);
            }
            if (isset($letter['subject'])) {
                $subject = $letter['subject'];
            }
            if (isset($letter['description'])) {
                $description = $letter['description'];
            }
            if (isset($letter['dabirkhone'])) {
                $dabirId = $letter['dabirkhone'];
            }
            if (isset($letter['text_letter'])) {
                $textLetter = $letter['text_letter'];
            }
            if (isset($letter['date_create'])) {
                $date_create = $letter['date_create'];
            }
            if (isset($letter['sendinput'])) {
                if ($letter['date_save'] != '') {
                    $date_create = self::jaliliToMiladiTime($letter['date_save']);
                    $status_save = 1;
                }
            }
            if (isset($letter['print_size'])) {
                $print_size = $letter['print_size'];
            } else $print_size = 2;
            if (isset($letter['fileold'])) {
                $sql = 'select * from tbl_file where date_create=? order by name_create';
                $files = self::doSelect($sql, array($date_create));
                $old = sizeof($files);
                foreach ($files as $key => $file) {
                    foreach ($letter['fileold'] as $fileId) {
                        if ($file['id'] == $fileId) {
                            $files[$key]['del'] = 1;
                        }
                    }
                }
                foreach ($files as $file) {
                    if (!isset($file['del'])) {
                        $sql = 'delete from tbl_file where id=?';
                        self::doQuery($sql, array($file['id']));
                        $urlFile = 'public/uploads/letters/' . $date_create . '/' . $file['name_create'];
                        unlink($urlFile);
                    }
                    $olds = explode('-', $file['name_create']);
                    $olds = explode('.', $olds[1]);
                    $old = $olds[0];
                }
            }
            if ($old > 0) $fileUpload = 1;
            $old++;
            if (isset($_FILES['file'])) {
                $options = self::getoption();
                $file_upload_size = $options['file_upload_size'];
                $file = $_FILES['file'];
                $targetMain = 'public/uploads/letters/' . $date_create . '/';
                if ($edit != 'edit' && $edit == '' || !file_exists($targetMain)) mkdir($targetMain, 0755);
                for ($i = 0; $i < sizeof($file['name']); $i++) {
                    $fileNameUpload = $date_create . '-' . $old;
                    $fileName = $file['name'][$i];
                    $fileSize = $file['size'][$i];
                    $fileTmp = $file['tmp_name'][$i];
                    $fileError = $file['error'][$i];
                    $uploadOk = 1;

                    if ($fileSize > $file_upload_size) {
                        $uploadOk = 0;
                    }
                    if ($fileError) {
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 1) {
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nameCreate = $fileNameUpload . '.' . $ext;
                        $target = $targetMain . $fileNameUpload . '.' . $ext;
                        move_uploaded_file($fileTmp, $target);
                        $sql = 'insert into tbl_file (name,date_create,name_create) values(?,?,?)';
                        self::doQuery($sql, array($fileName, $date_create, $nameCreate));
                        $fileUpload = 1;
                    }
                    $old++;
                }
            }
            if ($edit != 'edit' && $state == 'forward' || ($state == '' && $edit == '')) {
                $params = array($input, $dabirId, $print_size, $subject, $textLetter, $description, $status, $date_create, $date_signature, '0', $levelCreate, $levelSignature, $reciveId, $reciveCc, $fileUpload);
                $sql = "INSERT INTO tbl_letter(input,dabirId,print_size,subject,text,description,status,date_create,date_signature,archive,levelId_create,levelId_signature,levelId_Recive,levelId_Cc,file) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                self::doQuery($sql, $params);
                self::doReport(3,'',$subject);
            } elseif ($edit == 'edit') {
                $letterId = $letter['letterId'];
                $params = array($input, $dabirId, $print_size, $subject, $textLetter, $description, $status, $date_create, $date_signature, '0', $levelSignature, $reciveId, $reciveCc, $fileUpload, $letterId);
                $sql = "UPDATE tbl_letter SET  input=?,dabirId=?,print_size=?,subject=?,text=?,description=?,status=?,date_create=?,date_signature=?,archive=?,levelId_signature=?,levelId_Recive=?,levelId_Cc=?,file=? WHERE id=?";
                self::doQuery($sql, $params);
                self::doReport(4,$letterId,$subject);
            }
            $sql = "select * from tbl_letter where date_create=?";
            $letter_send = self::doSelect($sql, array($date_create), 1);
            $letterId = $letter_send['id'];
            $message = 'نامه ثبت و به دبیرخانه ارسال شد';
            if (isset($letter['sendinput'])) {
                $forwardLevelId = $letter['sendinput'];
                $number_save = '';
                $date_number_input = '';
                if ($letter['number_save'] != '') {
                    $number_save = $letter['number_save'];
                    $status_save = 1;
                }
                if ($letter['date_number_input'] != '') {
                    $date_number_input = $letter['date_number_input'];
                }
                if ($status_save == 0) {
                    $sql = "update tbl_letter set date_number_input=?,input=1 where id=?";
                    $params = array( $date_number_input,$letterId);
                    self::doQuery($sql, $params);
                    $this->addNumberLetter($levelActive, $letterId);
                }
                else
                {
                    $sql = "update tbl_letter set date_numLetter=?,numLetter=?,date_number_input=?,input=1,status=2 where id=?";
                    $params = array($date_create,$number_save, $date_number_input, $letterId);
                    self::doQuery($sql, $params);
                }
                ///////////////////////
                if (isset($letter['reciveId'])) {
                    foreach ($letter['reciveId'] as $reciveId) {
                        $sql = "insert into tbl_letter_recive (letterId,levelId,forwardLevelId,recive_status,description,date_send) VALUES (?,?,?,?,?,?)";
                        $params = array($letterId, $reciveId, $forwardLevelId, 2, $description, $date_create);
                        self::doQuery($sql, $params);
                    }
                }
                if (isset($letter['reciveCc'])) {
                    foreach ($letter['reciveCc'] as $reciveId) {
                        $sql = "insert into tbl_letter_recive (letterId,levelId,forwardLevelId,recive_status,description,date_send) VALUES (?,?,?,?,?,?)";
                        $params = array($letterId, $reciveId, $forwardLevelId, 2, $description, $date_create);
                        self::doQuery($sql, $params);
                    }
                }
                $message = 'تامه ارسال شد';
            }
            return ['message' => $message, 'letterId' => $letterId];
        }
        elseif($chkedit==1)
        {
            return 'نامه قابل ویرایش نمی باشد.شماره نامه قبلا ثبت شده است!!';
        }
    }
    public function letter_save_edit_input($letter)
    {
        $message='';$edit='';$fileUpload=0;$levelActive =$date_create='';
        if(isset($letter['letterId']))
        {
            $letterId = $letter['letterId'];
            $sql="select * from tbl_letter where id=?";
            $chkLetter=self::doSelect($sql,array($letterId),1);
            $date_create=$chkLetter['date_create'];
            $old = 0;
            $fileUpload = 0;
            if (isset($letter['levelActive'])) $levelActive = $letter['levelActive'];
            if (isset($letter['fileold'])) {
                $sql = 'select * from tbl_file where date_create=? order by name_create';
                $files = self::doSelect($sql, array($date_create));
                $old = sizeof($files);
                foreach ($files as $key => $file) {
                    foreach ($letter['fileold'] as $fileId) {
                        if ($file['id'] == $fileId) $files[$key]['del'] = 1;
                    }
                }
                foreach ($files as $file) {
                    if (!isset($file['del'])) {
                        $sql = 'delete from tbl_file where id=?';
                        self::doQuery($sql, array($file['id']));
                        $urlFile = 'public/uploads/letters/' . $date_create . '/' . $file['name_create'];
                        unlink($urlFile);
                    }
                    $olds = explode('-', $file['name_create']);
                    $olds = explode('.', $olds[1]);
                    $old = $olds[0];
                }
                $edit='edit';
            }
            else
            {
                $sql = 'select * from tbl_file where date_create=? ';
                $files = self::doSelect($sql, array($date_create));
                foreach ($files as $file) {
                        $sql = 'delete from tbl_file where id=?';
                        self::doQuery($sql, array($file['id']));
                        $urlFile='';
                        $urlFile = 'public/uploads/letters/' . $date_create . '/' . $file['name_create'];
                        unlink($urlFile);
                }
                $edit='edit';
            }
            if ($old > 0) $fileUpload = 1;
            $old++;
            if (isset($_FILES['file'])) {
                $options = self::getoption();
                $file_upload_size = $options['file_upload_size'];
                $file = $_FILES['file'];
                $targetMain = 'public/uploads/letters/' . $date_create . '/';
                if ($edit != 'edit' && $edit == '' || !file_exists($targetMain)) mkdir($targetMain, 0755);
                for ($i = 0; $i < sizeof($file['name']); $i++) {
                    $fileNameUpload = $date_create . '-' . $old;
                    $fileName = $file['name'][$i];
                    $fileSize = $file['size'][$i];
                    $fileTmp = $file['tmp_name'][$i];
                    $fileError = $file['error'][$i];
                    $uploadOk = 1;
                    if ($fileSize > $file_upload_size)  $uploadOk = 0;
                    if ($fileError) $uploadOk = 0;
                    if ($uploadOk == 1) {
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $nameCreate = $fileNameUpload . '.' . $ext;
                        $target = $targetMain . $fileNameUpload . '.' . $ext;
                        move_uploaded_file($fileTmp, $target);
                        $sql = 'insert into tbl_file (name,date_create,name_create) values(?,?,?)';
                        self::doQuery($sql, array($fileName, $date_create, $nameCreate));
                        $fileUpload = 1;
                    }
                    $old++;
                }
            }
            self::doReport(4,$letterId);
            $message = 'ویرایش نامه با موفقیت انجام شد';
            $params = array( $fileUpload,$letterId);
            $sql = "update tbl_letter set file=? where id = ? ";
            self::doQuery($sql, $params);
        }
        return  $message;
    }
    public function addNumberLetter($levelId,$letterId)
    {
        $middleNumLetterInternal=$middleNumLetterIn=$middleNumLetterOut='';$startNumberLetter=0;$current_number='';$numLetter='';
        $year = self::MiladiTojalili(date("Y/m/d"));
        $y = explode('/', $year );
        //$year=substr($y[0],4,6);
        $year = $y[0];
        $sql = "SELECT * FROM tbl_dabirkhone where levelId=?";
        $dabirkhone = self::doSelect($sql,array($levelId),1);
        $middleNumLetterIn = $dabirkhone['middel_letter_in'];
        $middleNumLetterOut = $dabirkhone['middel_letter_out'];
        $middleNumLetterInternal = $dabirkhone['middel_letter_internal'];
        $startNumberLetter = $dabirkhone['startNumberLetter'];
        $current_number = $dabirkhone['current_number'];
        $dabirId = $dabirkhone['id'];
        //////////////////
        /*$sql = "SELECT count(id) as ROW_COUNT from  tbl_letter where numLetter<>'' and dabirId=?";
        $row = self::doSelect($sql,array($dabirId));*/
        $ROW_COUNT =$current_number+1;// $startNumberLetter+$row[0]['ROW_COUNT']+1;
        ///////////////////////
        $sql = "select * from tbl_letter where  status=1 and id=?";
        $params = array($letterId);
        $letter = self::doSelect($sql,$params,1);
        if(sizeof($letter)>0) {
            $sql="update tbl_dabirkhone set current_number=? where id=?";
            $params = array($ROW_COUNT, $dabirId);
            self::doQuery($sql, $params);
            $input=$letter['input'];
            if($input==1) {
                if ($middleNumLetterIn != '')
                    $numLetter = self::changeNumber($ROW_COUNT . "/" . $middleNumLetterIn . "/" . $year);
                else
                    $numLetter = self::changeNumber($year . "/" . $ROW_COUNT);
            }
            elseif($input==2)
            {
                if ($middleNumLetterOut != '')
                    $numLetter = self::changeNumber($ROW_COUNT . "/" . $middleNumLetterOut . "/" . $year);
                else
                    $numLetter = self::changeNumber($year . "/" . $ROW_COUNT);
            }
            elseif($input==0)
            {
                if ($middleNumLetterInternal != '')
                    $numLetter = self::changeNumber($ROW_COUNT . "/" . $middleNumLetterInternal . "/" . $year);
                else
                    $numLetter = self::changeNumber($year . "/" . $ROW_COUNT);
            }
            $dt=time();
            $sql = "update tbl_letter set date_numLetter=?,numLetter=?,status=2 where id=?";
            $params = array($dt,$numLetter, $letterId);
            self::doQuery($sql, $params);
            self::doReport(11,$letterId);
            return 'شماره ثبت و نامه ارسال شد';
        }
        else
        {
            return 'نامه امضاء نشده یا قبلا به این نامه شماره تعلق گرفته است';
        }
        return 'در روند ثبت شماره نامه مشکلی بوجود آمده با پشتیبان سیستم تماس حاصل فرمائید';
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
    public function sendStep2($values)
    {
        return 'با موفقیت ارسال شد';
    }
    public function showLetter($levelId,$letterId,$status='')
    {
        if($status=='edit')
        {
            $sql = "update tbl_letter set status=0,date_signature=''   where id=?";
            $params = array($letterId);
            self::doQuery($sql, $params);
            self::doReport(4,$letterId);
        }

		$sql = "update tbl_letter_recive set date_view=?,read_status=1  where levelId=? and letterId=? and date_view IS NULL";
		$date_show = time();
		$params = array($date_show, $levelId,$letterId);
		self::doQuery($sql, $params);
    }
    public function setSignature($values)
    {
        $levelId='';$sqlLevelId='';
        $letterId = $values['letterId'];
        if(isset($values['levelId'])) {
            $levelId = $values['levelId'];
        }
        $sql = 'select * from tbl_letter where id=?';
        $letter = self::doSelect($sql, array($letterId), 1);
        if($letter['status']==0) {
            $dt = time();
            $param=array($dt, $letterId);
            if($levelId!='')
            {
                $param=array($dt,$levelId, $letterId);
                $sqlLevelId=',levelId_signature=?';
            }
            $sql = 'update tbl_letter set status=1,date_signature=?'.$sqlLevelId.' where id=?';
            self::doQuery($sql, $param);
            self::doReport(5,$letterId);
            return 1;
        }
        elseif($letter['status']==1)
            return 2;
    }
    public function getLevelForwardAvailable($levelId)
    {
        $levelInfo=[];
        $chkDabir=0;
        $sql="SELECT * FROM tbl_level  WHERE semat LIKE '%دبیرخانه%' and userId<>0 and userId<>''"; // استخراج کگاربران برای دبیرخانه
        $levelDabir= self::doSelect($sql);
        foreach ($levelDabir as $level ) {
            if ($levelId == $level['id']) {
                $sql = "SELECT * FROM tbl_level where  status=1 and userId<>0 and userId<>''  ";
                $levelInfo = self::doSelect($sql);
                foreach ($levelInfo as $key => $value) {
                    if ($value['userId'] != '' || $value['userId'] != 0) {
                        $userId = $value['userId'];
                        $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                        $user = self::doSelect($sql, array($userId), 1);
                        $levelInfo[$key]['user'] = $user;
                    }
                }
                $chkDabir=1;
            }
        }
        if($chkDabir==0)
        {
            $userId = $_COOKIE['userId'];
            $sql = "SELECT * FROM tbl_level  WHERE id=? and status=1 and userId<>0 and userId<>''"; //استخراج پدر
            $levelInfos = self::doSelect($sql, array($levelId));
            foreach ($levelInfos as $level) {
                if ($level['parentId'] != 0) {
                    $parentId = $level['parentId'];
                    $sql = "SELECT * FROM tbl_level  WHERE id=? and status=1 and userId<>0 and userId<>''";
                    $levelParent = self::doSelect($sql, array($parentId), 1);
                    array_push($levelInfo, $levelParent);
                }
            }
            $sql = "SELECT * FROM tbl_level  WHERE parentId=? and userId<>0 and userId<>''"; // استخراج فرزندان
            $levelInfos = self::doSelect($sql, array($levelId));
            foreach ($levelInfos as $level) {
                    $sql = "SELECT * FROM tbl_level  WHERE id=? and status=1 and userId<>0 and userId<>''";
                    $levelParent = self::doSelect($sql, array($level['id']), 1);
                    array_push($levelInfo, $levelParent);
            }
            $sql="SELECT * FROM tbl_level  WHERE semat LIKE '%دبیرخانه%' and status=1 and userId<>0 and userId<>''"; // استخراج دبیرخانه
            $level= self::doSelect($sql);
            array_push($levelInfo, $level);

            foreach ($levelInfo as $key => $value) {
                if ($value['userId'] != '' || $value['userId'] != 0) {
                    $userId = $value['userId'];
                    $sql = "SELECT * FROM tbl_user  WHERE id=? ";
                    $user = self::doSelect($sql, array($userId), 1);
                    $levelInfo[$key]['user'] = $user;
                }
            }
        }
        return array_filter($levelInfo);
    }
    public function forwradType($letterId)
    {
        $signature='';
        $sql="select * from tbl_letter where id=? ";
        $letter=self::doSelect($sql,array($letterId),1);
        if($letter['status'] > 0) $signature= " where id<>1";
        $sql="SELECT * from  tbl_forward_type  ".$signature;
        $type= self::doSelect($sql);
        return $type;
    }
    public function saveFroward($values)
    {
        $reslut=0;$letterId=$forwardLevelId=$forwardType=$reciveIds='';
        if(isset($values['letterId']))  $letterId = $values['letterId']; else $reslut=1;
        if(isset($values['forwardId'])) $forwardLevelId = $values['forwardId']; else $reslut=1;
        if(isset($values['description'])) $description = $values['description'];
        if(isset($values['forwardType'])) if($values['forwardType']!=0 ) $forwardType = $values['forwardType']; else $reslut=1;
        if(isset($values['reciveId'])) $reciveIds = $values['reciveId']; else $reslut=1;
        $date_send=time();
        if($reslut==0)
        {
            foreach ($reciveIds as $levelId)
            {
                $sql = "INSERT INTO tbl_letter_recive (letterId,levelId,forwardLevelId,description,recive_status,date_send) VALUES (?,?,?,?,?,?)";
                $params= array($letterId,$levelId,$forwardLevelId,$description,$forwardType,$date_send);
                self::doQuery($sql,$params);
            }
            self::doReport(6,$letterId);
            return 'ارجاع با موفقیت انجام شد';
        }
        else  return 'ارجاع با مشکل مواجه شد';
    }
    public function movetoarchive($levelId,$letterId)
    {
        $sql = 'update tbl_letter_recive set archive=1 where letterId=? and levelId=?';
        self::doQuery($sql, array($letterId,$levelId));
        return 'با موفقیت به بایگانی انتقال داده شد';

    }
    public function deleteLetter($levelId,$letterId)
    {
        $message='';
        $sql="select * from tbl_letter_recive where letterId=?";
        $letter=self::doSelect($sql,array($letterId),1);
        if($letter['id'])
            $message='این نامه قبلا ارجاع شده و قابل حذف نمی باشد';
        else {
            $sql="select * from tbl_letter where id=?";
            $letter=self::doSelect($sql,array($letterId),1);
            $sql = 'DELETE FROM tbl_letter where status<=1 and  id=? and levelId_create=?';
            self::doQuery($sql, array($letterId, $levelId));
            self::doReport(7,$letterId,$letter['subject']);
            $message='نامه با موفقیت حذف شد';
        }
        return $message;

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
    public function answer($levelId,$letterId,$answer)
    {
        $levelId=intval($levelId);
        $letterId=intval($letterId);
        $answer=strip_tags($answer);
        $dt=time();
        $sql="update  tbl_letter_recive set answer=?,date_answer=? where letterId=? and levelId=?  ";
        $param=array($answer,$dt,$letterId,$levelId);
        self::doQuery($sql,$param);
        self::doReport(10,$letterId);
        return 1;

    }
    public function saveAction($action_id,$letterId){
        self::doReport($action_id,$letterId);
    }
}
?>