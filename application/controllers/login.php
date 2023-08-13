<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
	}

public function index(){
    $this->load->view('register');
}

    public function userlogin($name){
        $data['name'] = $name;
        print_r($data);
        $this->load->view('login',$data);
    }
}