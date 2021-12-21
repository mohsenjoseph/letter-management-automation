<?php
class Letter extends Controller
{
    function __construct()
    {
        $chk=Model::checkUser();
        if(!$chk)
            header('location:'.URL.'login');
    }
    public function index($levelId='',$box='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            $itemBox = '';
            @$page = $_GET['page'];
            $letters = [];
            $user = $this->model->getUserFull();
            if ($levelId == '') {
                $levelId = $user['levelInfo'][0]['id'];
            }
            if ($box == '' || $box == 'index') {
                $itemBox = 'index';
                $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
            }
            if ($box == 'draft') {
                $itemBox = 'draft';
                $letters = $this->model->getLetterDraft($levelId,$itemBox,$page);
            }
            if ($box == 'send') {
                $itemBox = 'send';
                $letters = $this->model->getLetterSend($levelId,$itemBox,$page);
            }
            if ($box == 'archive') {
                $itemBox = 'archive';
                $letters = $this->model->getLetterArchive($levelId,$itemBox,$page);
            }

            $counterLetter = $this->model->counterLetter($levelId);
            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter' => $counterLetter,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '2'];
            $this->view('letter/index', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function create($levelId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $user = $this->model->getUserFull();
            $levelAvailable = $this->model->getLevelAvailable();
            $dabirAvailable = $this->model->getDabirAvailable();
            $reciveAvailable = $this->model->getReciveAvailable();
            $data = ['user' => $user,
                'levelAvailable' => $levelAvailable,
                'reciveAvailable' => $reciveAvailable,
                'dabirAvailable' => $dabirAvailable,
                'levelActive' => $levelId,
                'itemBox' => 'index',
                'activemenu' => '2'];

            $this->view('letter/create', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function send()
    {
        $message='';$itemBox='';
        @$page = $_GET['page'];
        $levelId = $_POST['levelActive'];
        if(isset($_POST['draft'])) {
            $message = $this->model->letterDraft($_POST);
            $itemBox = 'draft';
            $user= $this->model->getUserFull();
            if($levelId=='') $levelId=$user['levelInfo'][0]['id'];
            $counterLetter=$this->model->counterLetter($levelId);
            $letters= $this->model->getLetterDraft($levelId,$itemBox,$page);
            $data=['user'=>$user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter'=>$counterLetter,
                'levelActive'=>$levelId,
                'itemBox'=>$itemBox,
                'message'=>$message,
                'activemenu'=>'2'];
            //$refer=$_POST['referr'];
            //header('location:'.$refer);
            $this->view('letter/index',$data);
        }
        elseif(isset($_POST['send'])) {
            $out=$this->model->letterSend($_POST);
            $message = $out['message'];
            $itemBox = 'send';
            $user= $this->model->getUserFull();
            if($levelId=='') $levelId=$user['levelInfo'][0]['id'];
            $counterLetter=$this->model->counterLetter($levelId);
            $letters= $this->model->getLetterSend($levelId,$itemBox,$page);
            $data=['user'=>$user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter'=>$counterLetter,
                'levelActive'=>$levelId,
                'itemBox'=>$itemBox,
                'message'=>$message,
                'activemenu'=>'2'];
            //$refer=$_POST['referr'];
            //header('location:'.$refer);
            $this->view('letter/index',$data);
        }
        elseif(isset($_POST['forward'])) {
            $out= $this->model->letterSend($_POST,'forward');
            $letterId = $out['letterId'];
            $itemBox = 'index';
            $user = $this->model->getUserFull();
            $reciveAvailable = $this->model->getLevelForwardAvailable($levelId);
            $forwardType = $this->model->forwradType($letterId);
            $data = ['user' => $user,
                'letterId' => $letterId,
                'reciveAvailable' => $reciveAvailable,
                'forwardType' => $forwardType,
                'itemBox'=>$itemBox,
                'levelActive' => $levelId,
                'activemenu' => '2'];

           $this->view('letter/forward', $data);
        }

    }
    public function show($levelId,$itemBox,$letterId,$activemenu,$id)
    {
        if(Model::checkLevelUser($levelId)) {
            if ($itemBox != 'dabir') $this->model->showLetter($levelId, $letterId);
            $this->model->saveAction(9,$letterId);
            $user = $this->model->getUserFull($levelId);
            $letter = $this->model->getLetter($levelId, $itemBox, $letterId);
            $data = ['user' => $user,
                'levelActive' => $levelId,
                'letterId' => $letterId,
                'itemBox' => $itemBox,
                'letter' => $letter,
                'activemenu' => $activemenu];

            $this->view('letter/view', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function cycle($levelId,$itemBox,$letterId,$activemenu)
    {
        if(Model::checkLevelUser($levelId)) {
            $user = $this->model->getUserFull($levelId);
            $letter = $this->model->getCycleLetter($levelId, $itemBox, $letterId);
            $data = ['user' => $user,
                'levelActive' => $levelId,
                'letterId' => $letterId,
                'itemBox' => $itemBox,
                'letter' => $letter[0],
                'reciveLetter' => $letter[1],
                'activemenu' => $activemenu];
            $this->view('letter/cycle', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function signature()
    {
        $message='';
        $ids=$_POST;
        $message = $this->model->setSignature($ids);
        echo $message;
    }
    public function forward_dabir($letterId,$itembox='',$levelId='',$activemenu='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $itemBox = 'index';
            if (isset($_POST['levelActive'])) $levelId = $_POST['levelActive'];
            $user = $this->model->getUserFull();
            $levelAvailable = $this->model->getLevelSecretariatAvailable();
            $forwardType = $this->model->forwradType($letterId);
            $data = ['user' => $user,
                'letterId' => $letterId,
                'reciveAvailable' => $levelAvailable,
                'forwardType' => $forwardType,
                'itemBox' => $itemBox,
                'levelActive' => $levelId,
                'activemenu' => $activemenu];

            $this->view('letter/forward', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function forward($levelId='',$itemBox='',$letterId='',$activemenu='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            @$page = $_GET['page'];
            if ($itemBox == '') $itemBox = 'index';
            if (isset($_POST['forward'])) {
                if (isset($_POST['levelActive'])) $levelId = $_POST['levelActive'];
                if (isset($_POST['letterId'])) $letterId = $_POST['letterId'];
                $user = $this->model->getUserFull();
                $reciveAvailable = $this->model->getLevelForwardAvailable($levelId);
                $forwardType = $this->model->forwradType($letterId);
                $data = ['user' => $user,
                    'letterId' => $letterId,
                    'itemBox' => $itemBox,
                    'levelActive' => $levelId,
                    'reciveAvailable' => $reciveAvailable,
                    'forwardType' => $forwardType,
                    'activemenu' => '2'];
                $this->view('letter/forward', $data);
            } else if (isset($_POST['sendStep2'])) {
                if (isset($_POST['levelActive'])) $levelId = $_POST['levelActive'];
                $message = $this->model->sendStep2($_POST);
                $user = $this->model->getUserFull();
                if ($levelId == '') $levelId = $user['levelInfo'][0]['id'];
                $counterLetter = $this->model->counterLetter($levelId);
                $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
                $itemBox = 'index';
                $data = ['user' => $user,
                    'letters' => $letters['letters'],
                    'paged_result' => $letters['paged_result'] ,
                    'counterLetter' => $counterLetter,
                    'levelActive' => $levelId,
                    'itemBox' => $itemBox,
                    'message' => $message,
                    'activemenu' => '2'];

                $this->view('letter/index', $data);
            } elseif (!isset($_POST['sendStep2']) && !isset($_POST['forward'])) {
                $user = $this->model->getUserFull();
                $reciveAvailable = $this->model->getLevelForwardAvailable($levelId);
                $forwardType = $this->model->forwradType($letterId);
                $data = ['user' => $user,
                    'letterId' => $letterId,
                    'itemBox' => $itemBox,
                    'levelActive' => $levelId,
                    'reciveAvailable' => $reciveAvailable,
                    'forwardType' => $forwardType,
                    'activemenu' => $activemenu];
                $this->view('letter/forward', $data);
            }
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function saveFroward($letterId,$levelId='',$box='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            @$page = $_GET['page'];
            $message = '';
            $itemBox = '';
            $letters = [];
            $values = $_POST;
            $values['letterId'] = $letterId;
            $levelId = $values['forwardId'];
            $referrPage = $values['referr'];
            $message = $this->model->saveFroward($values);
            $user = $this->model->getUserFull();
            if ($box == '' || $box == 'index') {
                $itemBox = 'index';
                $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
            }
            if ($box == 'send') {
                $itemBox = 'send';
                $letters = $this->model->getLetterSend($levelId,$itemBox,$page);
            }
            $counterLetter = $this->model->counterLetter($levelId);
            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter' => $counterLetter,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '2'];
            //header('location:'.$referrPage);
            $this->view('letter/index', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function edit($levelId,$itemBox,$letterId)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $this->model->showLetter($levelId, $letterId, 'edit');
            $user = $this->model->getUserFull();
            $dabirAvailable = $this->model->getDabirAvailable();
            $levelAvailable = $this->model->getLevelAvailable();
            $reciveAvailable = $this->model->getReciveAvailable();
            $letter = $this->model->getLetter($levelId, $itemBox, $letterId);
            $data = ['user' => $user,
                'letter' => $letter,
                'levelActive' => $levelId,
                'dabirAvailable' => $dabirAvailable,
                'levelAvailable' => $levelAvailable,
                'reciveAvailable' => $reciveAvailable,
                'itemBox' => $itemBox,
                'activemenu' => '2'];
            $this->view('letter/edit', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function editinput($levelId,$itemBox,$letterId)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            //$this->model->showLetter($levelId,$letterId,'edit');
            $user = $this->model->getUserFull();
            $dabirAvailable = $this->model->getDabirAvailable();
            $levelAvailable = $this->model->getLevelAvailable();
            $reciveAvailable = $this->model->getReciveAvailable();
            $letter = $this->model->getLetter($levelId, $itemBox, $letterId);
            $data = ['user' => $user,
                'letter' => $letter,
                'levelActive' => $levelId,
                'dabirAvailable' => $dabirAvailable,
                'levelAvailable' => $levelAvailable,
                'reciveAvailable' => $reciveAvailable,
                'itemBox' => $itemBox,
                'activemenu' => '3'];
            $this->view('letter/editinput', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function saveEdit($levelId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            @$page = $_GET['page'];
            $message = '';
            $itemBox = '';
            $letters = [];
            if (isset($_POST['save'])) {
                $message = $this->model->letterDraft($_POST, 'edit');
                $itemBox = 'index';
                $user = $this->model->getUserFull();
                if ($levelId == '') $levelId = $user['levelInfo'][0]['id'];
                $counterLetter = $this->model->counterLetter($levelId);
                //if($itemBox == 'draft') {
                //    $letters= $this->model->getLetterDraft($levelId);
                //}
                // if($itemBox == '') {
                $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
                $itemBox = 'index';
                // }
                $data = ['user' => $user,
                    'letters' => $letters['letters'],
                    'paged_result' => $letters['paged_result'] ,
                    'counterLetter' => $counterLetter,
                    'levelActive' => $levelId,
                    'itemBox' => $itemBox,
                    'message' => $message,
                    'activemenu' => '2'];
                $this->view('letter/index', $data);
            } elseif (isset($_POST['send'])) {
                $out = $this->model->letterSend($_POST, '', 'edit');
                $message = $out['message'];
                $itemBox = 'send';
                $user = $this->model->getUserFull();
                if ($levelId == '') $levelId = $user['levelInfo'][0]['id'];
                $counterLetter = $this->model->counterLetter($levelId);
                if ($itemBox == 'draft') {
                    $letters = $this->model->getLetterDraft($levelId,$itemBox,$page);
                }
                if ($itemBox == '') {
                    $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
                    $itemBox = 'index';
                }
                $data = ['user' => $user,
                    'letters' => $letters['letters'],
                    'paged_result' => $letters['paged_result'] ,
                    'counterLetter' => $counterLetter,
                    'levelActive' => $levelId,
                    'itemBox' => $itemBox,
                    'message' => $message,
                    'activemenu' => '2'];
                $this->view('letter/index', $data);
            } elseif (isset($_POST['forward'])) {
                $itemBox = 'index';
                $out = $this->model->letterSend($_POST, 'forward', 'edit');
                $levelId = $_POST['levelActive'];
                $letterId = $out['letterId'];
                $user = $this->model->getUserFull();
                $reciveAvailable = $this->model->getLevelForwardAvailable($levelId);
                $forwardType = $this->model->forwradType($letterId);
                $data = ['user' => $user,
                    'letterId' => $letterId,
                    'reciveAvailable' => $reciveAvailable,
                    'forwardType' => $forwardType,
                    'levelActive' => $levelId,
                    'activemenu' => '2'];
                $this->view('letter/forward', $data);
            }
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function movetoarchive($levelId,$itemBox,$letterId,$activemenu)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            $itemBox = '';
            $letters = [];
            @$page = $_GET['page'];
            $message = $this->model->movetoarchive($levelId, $letterId);
            $user = $this->model->getUserFull();
            if ($levelId == '') {
                $levelId = $user['levelInfo'][0]['id'];
            }
            $itemBox = 'index';
            $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
            $counterLetter = $this->model->counterLetter($levelId);
            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter' => $counterLetter,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '2'];

            $this->view('letter/index', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function deleteLetter($levelId,$itemBox,$letterId,$activemenu)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            @$page = $_GET['page'];
            $message = $this->model->deleteLetter($levelId, $letterId);
            $user = $this->model->getUserFull();
            if ($levelId == '') {
                $levelId = $user['levelInfo'][0]['id'];
            }
            if ($itemBox == '' || $itemBox == 'index') {
                $itemBox = 'index';
                $letters = $this->model->getLetterRecive($levelId,$itemBox,$page);
            }
            if ($itemBox == 'draft') {
                $itemBox = 'draft';
                $letters = $this->model->getLetterDraft($levelId,$itemBox,$page);
            }
            if ($itemBox == 'send') {
                $itemBox = 'send';
                $letters = $this->model->getLetterSend($levelId,$itemBox,$page);
            }
            if ($itemBox == 'archive') {
                $itemBox = 'archive';
                $letters = $this->model->getLetterArchive($levelId,$itemBox,$page);
            }
            $counterLetter = $this->model->counterLetter($levelId);
            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'counterLetter' => $counterLetter,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '2'];

            $this->view('letter/index', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function dabirkhone($levelId='',$itemBox='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $page=0;
            @$page = $_GET['page'];
            $message = '';
            $letters = [];
            $user = $this->model->getUserFull();
            if ($levelId == '') $levelId = $user['levelInfo'][0]['id'];
            if ($itemBox == '' || $itemBox == 'index') {
                //$itemBox = 'index';
                $letters = $this->model->getLetterRecive($levelId, 'dabir',$page);
            } elseif ($itemBox == 'input') {
                //$itemBox = 'input';
                $letters = $this->model->getLetterInput($levelId, 'dabir',$page, $itemBox);
            } elseif ($itemBox == 'send') {
                //$itemBox = 'send';
                $letters = $this->model->getLetterSend($levelId, 'dabir',$page, $itemBox);
            } elseif ($itemBox == 'intrnal') {
                //$itemBox = 'intrnal';
                $letters = $this->model->getLetterIntrnal($levelId, 'dabir',$page, $itemBox);
            }
            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '3'];
            //print_r($data);
            $this->view('letter/dabir_inbox', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function createinput($levelId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $user = $this->model->getUserFull();
            $itemBox = 'input';
            $dabirId = $this->model->getDabirAvailable($levelId);
            $levelAvailable = $this->model->getLevelSecretariatAvailable();
            $reciveAvailable = $this->model->getReciveAvailable($levelId);
            $data = ['user' => $user,
                'levelAvailable' => $levelAvailable,
                'itemBox' => $itemBox,
                'reciveAvailable' => $reciveAvailable,
                'dabirId' => $dabirId,
                'levelActive' => $levelId,
                'activemenu' => '3'];
            $this->view('letter/createinput', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function sendinput($levelId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            @$page = $_GET['page'];
            $message = '';
            $itemBox = '';
            $letters = [];
            if (isset($_POST['send'])) {
                $out = $this->model->letterSend($_POST);
                $message = $out['message'];
            }
            $user = $this->model->getUserFull();
            $itemBox = 'input';
            $letters = $this->model->getLetterSend('dabir', 'input',$page);

            $data = ['user' => $user,
                'letters' => $letters['letters'],
                'paged_result' => $letters['paged_result'] ,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => '3'];
            header('location:' . URL . '/letter/dabirkhone/' . $levelId . '/input');
            //$this->view('letter/dabirkhone',$data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function saveeditinput($levelId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            $itemBox = '';
            $letters = [];
            if (isset($_POST['send'])) {
                $out = $this->model->letter_save_edit_input($_POST);
                $message = $out['message'];
            }
            /*$user= $this->model->getUserFull();
            $itemBox = 'input';
            $letters = $this->model->getLetterSend('dabir','input');

            $data=['user'=>$user,
                'letters'=>$letters,
                'levelActive'=>$levelId,
                'itemBox'=>$itemBox,
                'message'=>$message,
                'activemenu'=>'3'];*/
            header('location:' . URL . '/letter/dabirkhone/' . $levelId . '/input');
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
   /* public function printLetter($levelId,$itemBox,$letterId,$activemenu)
    {
        $user = $this->model->getUserFull($levelId);
        $option = $this->model->printOption();
        $letter = $this->model->getLetter($levelId,'dabir',$letterId);
        $data=['user'=>$user,
            'print'=>'print',
            'option'=>$option,
            'itemBox'=>$itemBox,
            'letter'=>$letter,
            'letterId'=>$letterId,
            'levelActive'=>$levelId,
            'activemenu'=>$activemenu];
        $this->view('mpdf/examples/print',$data);
    }*/
    public function eprintLetter($levelId,$itemBox,$letterId,$activemenu,$typePrint='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $user = $this->model->getUserFull($levelId);
            $this->model->saveAction(8,$letterId);
            $option = $this->model->printOption();
            $letter = $this->model->getLetter($levelId, 'dabir', $letterId);
            $data = ['user' => $user,
                'print' => 'print',
                'option' => $option,
                'itemBox' => $itemBox,
                'letter' => $letter,
                'letterId' => $letterId,
                'levelActive' => $levelId,
                'activemenu' => $activemenu];
            $this->view('letter/print', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function eprintLetterDabir()
    {
        $levelId=$_POST['levelId'];
        $letterId=$_POST['letterId'];
        $itemBox=$_POST['itemBox'];
        $activemenu=$_POST['activemenu'];
        $text=$_POST['text_letter'];
        $printSize=$_POST['print_size'];
        $user = $this->model->getUserFull($levelId);
        $option = $this->model->printOption();
        $letter = $this->model->getLetter($levelId,'dabir',$letterId);
        $data=['user'=>$user,
            'print'=>'print',
            'option'=>$option,
            'itemBox'=>$itemBox,
            'letter'=>$letter,
            'text'=>$text,
            'print_size'=>$printSize,
            'letterId'=>$letterId,
            'levelActive'=>$levelId,
            'activemenu'=>$activemenu];
        $this->view('letter/printDabir',$data);
    }
   /* public function printPreview()
    {
        $signatureId='';$signatureInfo='';
        if(isset($_POST['text_letter'])) {
            $option = $this->model->printOption();
            $text = $_POST['text_letter'];
            if ($_POST['date_signature'] != '') {
                $signatureId = $_POST['date_signature'];
                $signatureInfo = $this->model->infoLevel($signatureId);
            }
            $print_size = $_POST['print_size'];
            $data = ['print' => 'print',
                'option' => $option,
                'print_size' => $print_size,
                'signatureId' => $signatureId,
                'signatureInfo' => $signatureInfo,
                'text' => $text];
            $this->view('mpdf/examples/printPreview', $data);
        }
    }*/
    public function eprintPreview()
    {
        $signatureId='';$signatureInfo='';$reciveCc=[];
        if(isset($_POST['text_letter'])) {
            $option = $this->model->printOption();
            $text = $_POST['text_letter'];
            if ($_POST['date_signature'] != '') {
                $signatureId = $_POST['date_signature'];
                $signatureInfo = $this->model->infoLevel($signatureId);
            }
            if (isset($_POST['reciveCc']) ) {
                $i=0;
                foreach ($_POST['reciveCc'] as $reciveCcId) {
                    $ccId=intval($reciveCcId);
                    if($ccId>0) {
                        $reciveCc[$i] = $this->model->infoLevel($reciveCcId);
                    }
                    else
                    {
                        $reciveCc[$i] =$reciveCcId;
                    }
                    $i++;
                }
            }
            $print_size = $_POST['print_size'];
            $data = ['print' => 'print',
                'option' => $option,
                'print_size' => $print_size,
                'signatureId' => $signatureId,
                'reciveCc' => $reciveCc,
                'signatureInfo' => $signatureInfo,
                'text' => $text];
            $this->view('letter/printPreview', $data);
        }
    }
    public function eprintLetterPreview($levelId,$itemBox,$letterId)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $this->model->showLetter($levelId, $letterId);
            $this->model->saveAction(12,$letterId);
            $user = $this->model->getUserFull();
            $dabirAvailable = $this->model->getDabirAvailable();
            $levelAvailable = $this->model->getLevelAvailable();
            $reciveAvailable = $this->model->getReciveAvailable();
            $letter = $this->model->getLetter($levelId, $itemBox, $letterId);
            $data = ['user' => $user,
                'letter' => $letter,
                'levelActive' => $levelId,
                'dabirAvailable' => $dabirAvailable,
                'levelAvailable' => $levelAvailable,
                'reciveAvailable' => $reciveAvailable,
                'itemBox' => $itemBox,
                'activemenu' => '3'];
            $this->view('letter/editDabir', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function addNumber($levelId='',$itemBox='',$letterId='')
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            $user = $this->model->getUserFull();
            if ($levelId == '') $levelId = $user['levelInfo'][0]['id'];

            $message = $this->model->addNumberLetter($levelId, $letterId);
            $this->model->letterOnlySend($letterId, $levelId);
            if ($itemBox != '')
                header('location:' . URL . 'letter/dabirkhone/' . $levelId . '/' . $itemBox);
            else
                header('location:' . URL . 'letter/dabirkhone/' . $levelId . '/index');
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function search($levelId,$itemBox,$activemenu)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            $message = '';
            $searchParam = $_POST;
            $user = $this->model->getUserFull();
            if ($levelId == '') {
                $levelId = $user['levelInfo'][0]['id'];
            }
            $letters = $this->model->getLetterSearch($levelId, $itemBox, $searchParam);
            $counterLetter = $this->model->counterLetter($levelId);

            $data = ['user' => $user,
                'letters' => $letters,
                'counterLetter' => $counterLetter,
                'levelActive' => $levelId,
                'itemBox' => $itemBox,
                'message' => $message,
                'activemenu' => $activemenu];

            $this->view('letter/index', $data);
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function searchDabir($levelId,$itemBox,$activemenu)
    {
        if(Model::checkLevelUser($levelId) || $levelId=='') {
            if ($levelId != '') {
                $message = '';
                $searchParam = $_POST;
                $user = $this->model->getUserFull();
                $letters = $this->model->getLetterSearchDabir($levelId, $itemBox, $searchParam);
                $counterLetter = $this->model->counterLetter($levelId);

                $data = ['user' => $user,
                    'letters' => $letters,
                    'counterLetter' => $counterLetter,
                    'levelActive' => $levelId,
                    'itemBox' => $itemBox,
                    'message' => $message,
                    'activemenu' => $activemenu];

                $this->view('letter/dabir_inbox', $data);
            }
        }
        else
            echo "شما اجازه دسترسی به این صفحه را ندارید";
    }
    public function counterLetterRecive()
    {
        $levelId=$_POST['levelId'];
        $letterUnRead=$this->model->counterLetterRecive($levelId);
        echo $letterUnRead;
    }
    public function noNumberLetter()
    {
        $levelId=$_POST['levelId'];
        $NumberLetter=$this->model->noNumberLetter($levelId);
        echo $NumberLetter;
    }
    public function answer()
    {
        $levelId=$_POST['levelId'];
        $letterId=$_POST['letterId'];
        $answer=$_POST['answer'];
        $this->model->answer($levelId,$letterId,$answer);
        $user= $this->model->getUserFull();
        $itemBox = 'index';
        $letters = $this->model->getLetterRecive($levelId);
        $counterLetter=$this->model->counterLetter($levelId);
        $data=['user'=>$user,
            'letters'=>$letters,
            'counterLetter'=>$counterLetter,
            'levelActive'=>$levelId,
            'itemBox'=>$itemBox,
            'message'=>'پاسخ نامه ارسال شد.',
            'activemenu'=>'2'];

        $this->view('letter/index',$data);
    }
}