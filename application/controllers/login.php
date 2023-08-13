<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
	}

    public function index(){
        $this -> load -> view('register');
    }
    
    // userlogin method

    public function userlogin($name){
        // logic need to create
        $data['name'] = $name;
        print_r($data);
        $this->load->view('login',$data);
    }

    public function registerSubmit(){
        $this->form_validation->set_rules('name','name', 'required');
        $this->form_validation->set_rules('email','email', 'required');
        $this->form_validation->set_rules('password','This stf required', 'required');
        $this->form_validation->set_rules('address','This stf required', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('myform');
                }
                else
                {
                        // $this->load->view('formsuccess')
                        echo 'sucess';
                }
    }
}
