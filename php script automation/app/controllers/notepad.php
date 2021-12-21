<?php

class Notepad extends Controller
{
    function __construct()
    {
        $chk=Model::checkUser();
        if(!$chk)
            header('location:'.URL.'login');    }
    function tel()
    {
        $user = $this->model->getUserFull();
        $phones = $this->model->getPhones();

        $data = ["user" => $user,'itemBox'=>'index',"phones"=>$phones,'activemenu'=>'6'];

        $this->view('notepad/tell', $data);
    }
    function delete()
    {
        $ids = $_POST['id'];

        $message =$this->model->delete($ids);
        $phones = $this->model->getPhones();
        $user = $this->model->getUserFull();
        $data = ["phones" => $phones,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'6'];

        $this->view('notepad/tell',$data);
    }
    function savetell()
    {
        $ids = $_POST;
        $message = $this->model->addtell($ids);

        $phones = $this->model->getPhones();
        $user = $this->model->getUserFull();
        $data = ["phones" => $phones,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'6'];

        $this->view('notepad/tell',$data);
    }
    function addtell($phoneId='')
    {
        $phone='';
        if($phoneId!='') $phone = $this->model->getPhone($phoneId);
        $user = $this->model->getUserFull();
        $data = ["phone" => $phone,
            'itemBox'=>'index',
            "user"=>$user,
            'phoneId'=>$phoneId,
            'activemenu'=>'6'];

        $this->view('notepad/addtell',$data);
    }
    function addwork($workId='')
    {
        $work='';
        if($workId!='') $work = $this->model->getwork($workId);
        $user = $this->model->getUserFull();
        $data = ["work" => $work,
            'itemBox'=>'index',
            "user"=>$user,
            'workId'=>$workId,
            'activemenu'=>'6'];

        $this->view('notepad/addwork',$data);
    }
    function savework()
    {
        $ids = $_POST;
        $message = $this->model->addwork($ids);

        $works = $this->model->getworks();
        $user = $this->model->getUserFull();
        $data = ["works" => $works,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'6'];

        $this->view('notepad/work',$data);
    }
    function deletework()
    {
        $ids = $_POST['id'];

        $message =$this->model->deletework($ids);
        $works = $this->model->getworks();
        $user = $this->model->getUserFull();
        $data = ["works" => $works,'itemBox'=>'index','message'=>$message,"user"=>$user,'activemenu'=>'6'];

        $this->view('notepad/work',$data);
    }
    function work()
    {
        $user = $this->model->getUserFull();
        $works = $this->model->getworks();

        $data = ["user" => $user,'itemBox'=>'index',"works"=>$works,'activemenu'=>'6'];

        $this->view('notepad/work', $data);
    }
    function numWorkToday()
    {
        $NumWork=$this->model->numWorkToday();
        echo $NumWork;
    }
}