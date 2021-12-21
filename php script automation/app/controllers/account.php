<?php

class Account extends Controller
{
    function __construct()
    {
        $chk=Model::checkUser();
        if(!$chk)
            header('location:'.URL.'login');
    }
    function index()
    {
        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user', $data);
    }
    function changelevel1()
    {
        $ids = $_POST['id'];

        $this->model->changelevel1($ids);
        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user',$data);
    }
    function changelevel2()
    {
        $ids = $_POST['id'];

        $this->model->changelevel2($ids);
        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user',$data);
    }
    function changelevel3()
    {
        $ids = $_POST['id'];

        $this->model->changelevel3($ids);
        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user',$data);
    }
    function delete()
    {
        $ids = $_POST['id'];

        $message =$this->model->delete($ids);
        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user',$data);
    }
    function saveuser()
    {
        $ids = $_POST;
        $message = $this->model->adduser($ids);

        $users = $this->model->getUsers();
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'4'];

        $this->view('account/user',$data);
    }
    function adduser($userId='')
    {
        $users = $this->model->getUsers($userId);
        $user = $this->model->getUserFull();
        $data = ["users" => $users,'itemBox'=>'index',"user"=>$user,'userId'=>$userId,'activemenu'=>'4'];

        $this->view('account/adduser',$data);
    }
    function showLevel()
    {
        $levels = $this->model->getLevels();
        $user = $this->model->getUserFull();
        $data = ["levels" => $levels,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/level', $data);
    }
    function subLevel()
    {
        $levelId=$_POST['levelId'];
        $levels = $this->model->getsubLevels($_POST);
        $showLevels='<ul style="padding-right:30px" class="parent'.$levelId.'">';
        foreach($levels as $row)
        {
            $showLevels .= '<li id="parent' . $row['id'] . '" >';
            if($row['parentstate']!=0) {
                $showLevels .= '<i class="icon-plus" meta-data="0"  onclick="showParent(this,' . $row['id'] . ')" title="نمایش زیر مجموعه"></i>&nbsp;';
            }
            else
                $showLevels .=  '<i class="icon-minus" ></i>&nbsp;';
            $showLevels.='سمت:'. $row['semat'].' |
نام محترمانه:    '. $row['semattop'].' |
حق امضاء: ';
if($row['signature_status']==1) $showLevels.= "دارد"; else $showLevels.= "ندارد";
$showLevels.=' |
نام کاربر:   '. $row['userinfo'].' |
<input type="checkbox" name="id[]" value="'. $row['id'].'">
<a href="addLevel/'.$row['id'].'"><i class="icon-edit"></i></a>
</li>';
        }
        $showLevels=$showLevels."</ul>";
        echo $showLevels;
    }
    function deleteLevel()
    {
        $ids = $_POST['id'];

        $this->model->deleteLevel($ids);
        $levels = $this->model->getLevels();
        $user = $this->model->getUserFull();
        $data = ["levels" => $levels,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/level',$data);
    }
    function saveLevel()
    {
        $ids = $_POST;
        $this->model->addLevel($ids);

        $levels = $this->model->getLevels();
        $user = $this->model->getUserFull();
        $data = ["levels" => $levels,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/level',$data);
    }
    function addLevel($levelId='')
    {
            $level = $this->model->getLevels($levelId);
            $levels = $this->model->getLevelsOff();
            $user = $this->model->getUserFull();
            $users = $this->model->getAllUserFull();
            $data = ["level" => $level, 'itemBox' => 'index', "levels" => $levels, "users" => $users, "user" => $user, 'levelId' => $levelId, 'activemenu' => '4'];
            $this->view('account/addlevel', $data);
    }
    function userLevel()
    {
        $levels = $this->model->getLevelsOff();
        $user = $this->model->getUserFull();
        $users = $this->model->getAllUserFull();
        $data = ["levels" => $levels,'itemBox'=>'index',"users"=>$users,"user"=>$user,'activemenu'=>'4'];

        $this->view('account/userlevel',$data);
    }
    function editUserLevel()
    {
        $ids = $_POST;
        $this->model->editUserLevel($ids);

        $levels = $this->model->getLevels();
        $user = $this->model->getUserFull();
        $data = ["levels" => $levels,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/level',$data);
    }
    function checkUsername()
    {
        $username = $_POST['username'];
        $message =$this->model->checkUsername($username);
        echo $message;
    }
    function dabirkhone()
    {
        $dabirkhone = $this->model->getDabirkhone();
        $user = $this->model->getUserFull();
        $data = ["dabirkhones" => $dabirkhone,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/dabirkhone', $data);
    }
    function addDabirkhone($dabirId='')
    {
        $dabirkhone=[];
        $levels = $this->model->getLevelsOff();
        if($dabirId!='') $dabirkhone = $this->model->getDabirkhone($dabirId);
        $user = $this->model->getUserFull();

        $data = ["levels" => $levels,'dabirkhone'=>$dabirkhone,'dabirId'=>$dabirId,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/addDabirkhone',$data);
    }
    function saveDabirkhone()
    {
        $ids = $_POST;
        $this->model->saveDabirkhone($ids);

        $dabirkhone = $this->model->getDabirkhone();
        $user = $this->model->getUserFull();
        $data = ["dabirkhones" => $dabirkhone,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/dabirkhone', $data);
    }
    function deleteDabir()
    {
        $ids = $_POST['id'];
        $this->model->deleteDabir($ids);

        $dabirkhone = $this->model->getDabirkhone();
        $user = $this->model->getUserFull();
        $data = ["dabirkhones" => $dabirkhone,'itemBox'=>'index',"user"=>$user,'activemenu'=>'4'];

        $this->view('account/dabirkhone', $data);
    }
    function del_signature()
    {
        $chk = $this->model->del_signature($_POST);
        echo $chk;
        //$user = $this->model->getUserFull();
        //$data = ["user" => $user, 'itemBox'=>'index','activemenu' => '5','message'=>$chk];

        //$this->view('profile/index', $data);
    }
    function del_pic_profile()
    {
        $chk = $this->model->del_pic_profile($_POST);
        echo $chk;
        //$user = $this->model->getUserFull();
        //$data = ["user" => $user, 'itemBox'=>'index','activemenu' => '5','message'=>$chk];

        //$this->view('profile/index', $data);
    }

}