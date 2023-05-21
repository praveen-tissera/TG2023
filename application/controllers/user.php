<?php

class User extends CI_Controller{

    public function index(){
        $this->load->view('contactus');
    }
    public function loginUser(){
        $data['welcome'] = "Hello User.";
        $data['userID'] = 123455;

        $this->load->view('login',$data);
    }
    public function userID($id){
        $data['userid'] = $id;
        $this->load->view('userlist', $data);
    }
}