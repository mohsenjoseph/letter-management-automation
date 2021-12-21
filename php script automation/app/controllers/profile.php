<?php

class Profile extends Controller
{
    function __construct()
    {
        $chk=Model::checkUser();
        if(!$chk)
            header('location:'.URL.'login');
    }
    function index()
    {
        $user = $this->model->getUserFull();
        $data = ["user"=>$user,'itemBox'=>'index','activemenu'=>'5'];

        $this->view('profile/index', $data);
    }
    function save_profile()
    {
        $chk = $this->model->saveProfileEdit($_POST);
        $user = $this->model->getUserFull();
        $data = ["user" => $user, 'itemBox'=>'index','activemenu' => '5','message'=>$chk];

        $this->view('profile/index', $data);
    }
    function del_pic_profile()
    {
        $chk = $this->model->del_pic_profile($_POST);
        echo $chk;
        //$user = $this->model->getUserFull();
        //$data = ["user" => $user, 'itemBox'=>'index','activemenu' => '5','message'=>$chk];

        //$this->view('profile/index', $data);
    }
    function changepass()
    {
        $user = $this->model->getUserFull();
        $data = ["user"=>$user,'itemBox'=>'index','activemenu'=>'5'];

        $this->view('profile/changepass', $data);
    }
    function save_password()
    {
        $chk = $this->model->saveProfilePassword($_POST);
        $user = $this->model->getUserFull();
        $data = ["user" => $user,'itemBox'=>'index', 'activemenu' => '5','message'=>$chk];

        $this->view('profile/changepass', $data);
    }
    function setting()
    {
        $user = $this->model->getUserFull();
        $setting = $this->model->getSetting();
        $data = ["user"=>$user,'itemBox'=>'index','setting'=>$setting,'activemenu'=>'7'];

        $this->view('profile/setting', $data);
    }
    function savesetting()
    {
        $chk = $this->model->saveSetting($_POST);
        $user = $this->model->getUserFull();
        $setting = $this->model->getSetting();
        $data = ["user"=>$user,'setting'=>$setting,'activemenu'=>'7','message'=>$chk];

        $this->view('profile/setting', $data);
    }
    function save_pic_profile()
    {
        $chk = $this->model->save_pic_profile($_POST);
        ?>
        <script>
            window.close();
        </script>
    <?php
    }
    function chk_pic_profile()
    {
        $chk = $this->model->chk_pic_profile($_POST);
        echo $chk;

    }
    function report()
    {
        @$page = $_GET['page'];
        $user = $this->model->getUserFull();
        $report = $this->model->getReport($page);
        $data = ["user"=>$user,
            "report"=>$report['report'],
            'paged_result' => $report['paged_result'] ,
            'itemBox'=>'index',
            'activemenu'=>'8'];

        $this->view('profile/report', $data);
    }
}