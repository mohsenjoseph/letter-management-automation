<?php

class Secretariat extends Controller
{
    function __construct()
    {
        /*$chk=Model::checkUser();
        if(!$chk)
            header('location:'.URL.'login');*/
    }
    public function dabirkhone($levelId='',$box='')
    {
        $message='';$itemBox='';$letters=[];
        $user= $this->model->getUserFull();
        if($levelId=='') $levelId=$user['levelInfo'][0]['id'];
        if($box == '' || $box == 'index') {
            $itemBox = 'index';
            $letters = $this->model->getLetterRecive();
        }
        if($box == 'send') {
            $itemBox = 'send';
            $letters = $this->model->getLetterSend();
        }
        $data=['user'=>$user,
            'letters'=>$letters,
            'levelActive'=>$levelId,
            ,'itemBox'=>$itemBox,
            'message'=>$message,
            'activemenu'=>'3'];
        $this->view('secretariat/index',$data);
    }
    public function create($levelId='')
    {
        $user= $this->model->getUserFull();
        $levelAvailable= $this->model->getLevelSecretariatAvailable();
        $reciveAvailable= $this->model->getReciveAvailable($levelId);
        $data=['user'=>$user,'levelAvailable'=>$levelAvailable,'reciveAvailable'=>$reciveAvailable,'levelActive'=>$levelId,'activemenu'=>'3'];
        $this->view('secretariat/create',$data);
    }
    public function send($levelId='')
    {
        $message='';$itemBox='';$letters=[];
        if(isset($_POST['send'])) {
            $message = $this->model->letterSend($_POST);
        }
        $user= $this->model->getUserFull();
        $itemBox = 'send';
        $letters = $this->model->getLetterSend($levelId);

        $data=['user'=>$user,'letters'=>$letters,'activeLevel'=>$levelId,'itemBox'=>$itemBox,'message'=>$message,'activemenu'=>'3'];

        $this->view('secretariat/index',$data);

    }

    public function show($levelId,$itemBox,$letterId)
    {
        $this->model->showLetter($levelId,$letterId);
        $user = $this->model->getUserFull($levelId);
        $letter = $this->model->getLetter($letterId);
        $data=['user'=>$user,'letter'=>$letter,'letterId'=>$letterId,'levelActive'=>$levelId,'activemenu'=>'3'];
        $this->view('secretariat/view',$data);
    }
    public function printLetter($levelId,$letterId)
    {
        $user = $this->model->getUserFull($levelId);
        $option = $this->model->printOption();
        $letter = $this->model->getLetter($letterId);
        $data=['user'=>$user,'print'=>'print','option'=>$option,'letter'=>$letter,'letterId'=>$letterId,'levelActive'=>$levelId,'activemenu'=>'3'];
        $this->view('secretariat/print',$data);
    }
    public function addNumber($levelId,$box,$letterId)
    {
        $message='';$itemBox='';$letters=[];
        $user= $this->model->getUserFull();
        if($levelId=='') $levelId=$user['levelInfo'][0]['id'];

        $message = $this->model->addNumberLetter($letterId);
        $this->model->letterOnlySend($letterId,$levelId);

        $user= $this->model->getUserFull();
        if($levelId=='') $levelId=$user['levelInfo'][0]['id'];
        if($box == '' || $box == 'index') {
            $itemBox = 'index';
            $letters = $this->model->getLetterRecive($levelId);
        }

        $data=['user'=>$user,'letters'=>$letters,'activeLevel'=>$levelId,'itemBox'=>$itemBox,'message'=>$message,'activemenu'=>'3'];

        $this->view('secretariat/index',$data);
    }
    public function forward($letterId,$itembox='',$levelId='')
    {
        if(isset($_POST['levelActive'])) $levelId = $_POST['levelActive'];
        $user= $this->model->getUserFull();
        $levelAvailable= $this->model->getLevelSecretariatAvailable($letterId);
        $forwardType= $this->model->forwradType($letterId);
        $data=['user'=>$user,'letterId'=>$letterId,'levelAvailable'=>$levelAvailable,
            'forwardType'=>$forwardType,'levelActive'=>$levelId,'activemenu'=>'3'];

        $this->view('secretariat/forward',$data);
    }
    public function saveFroward($letterId,$levelId='',$box='')
    {
        $message='';$itemBox='';$letters=[];

        $values = $_POST;
        $values['letterId'] = $letterId;
        $message=$this->model->saveFroward($values);

        $user= $this->model->getUserFull();
        if($levelId=='') $levelId=$user['levelInfo'][0]['id'];
        if($box == '' || $box == 'index') {
            $itemBox = 'index';
            $letters = $this->model->getLetterRecive($levelId);
        }
        if($box == 'send') {
            $itemBox = 'send';
            $letters = $this->model->getLetterSend($levelId);
        }
        $data=['user'=>$user,'letters'=>$letters,'activeLevel'=>$levelId,'itemBox'=>$itemBox,'message'=>$message,'activemenu'=>'3'];
        $this->view('secretariat/index',$data);
    }
}
