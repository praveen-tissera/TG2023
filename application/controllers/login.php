<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->helper('form');
	}

    public function index(){
        $this -> load -> view('register')
    }
    
    // userlogin method

    public function userlogin($name){
        // logic need to create
        $data['name'] = $name;
        print_r($data);
        $this->load->view('login',$data);
    }
}
