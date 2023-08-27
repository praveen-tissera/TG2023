<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
<<<<<<< Updated upstream
=======
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
>>>>>>> Stashed changes
	}

    public function index(){
        $this->load->view('register');
    }
    // userlogin method

    public function userlogin($name){
        // logic need to create
        $data['name'] = $name;
        print_r($data);
        $this->load->view('login',$data);
    }
<<<<<<< Updated upstream
=======

    public function registerSubmit(){
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE){
                        $this->load->view('register');
                }
                else{
                    echo "success";
                    print_r($_POST);

                    //assosiative array 
                    
                        // $this->load->view('formsuccess');
                }
    }
>>>>>>> Stashed changes
}
