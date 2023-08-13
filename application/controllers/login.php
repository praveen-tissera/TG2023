<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->helper('form');

	}

public function index(){
    $this->load->view('register');
}

    public function userlogin($name){
        $data['name'] = $name;
        print_r($data);
        $this->load->view('login',$data);
    }

    public function registerSubmit(){
    echo "register submit";
    print_r($_POST);,
    }
}