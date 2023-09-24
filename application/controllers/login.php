<?php
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('register');
    }
    // userlogin method

    public function userlogin()
    {
        $this->load->view('login');
    }

    public function registerSubmit()
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            echo "success";
            // print_r($_POST);
            $current_date = date('Y-m-d');
            // associative array
            $data = array(
                'id' => NULL,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'address' => $_POST['address'],
                'created_date' =>  $current_date
            );

            // print_r($data);
            // pass this array to model
            $result = $this->user_model->registerUser($data);
            if ($result) {
                $data = array(
                    'success' => 'User Register Successfuly'
                );
                $this->load->view('register', $data);
            } else {
                $data = array(
                    'error' => 'User Exist with this Email. Please try again'
                );
                $this->load->view('register', $data);
            }


            // $this->load->view('formsuccess');
        }
    }

    public function loginsubmit()
    {
        print_r($_POST);
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $data = array(
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            );
            $result = $this->user_model->loginCheck($data);
            if ($result) {
                //set session
            } else {
                $data = array(
                    'error' => 'Email or Password is incorrect. Please check'
                );
                $this->load->view('register', $data);
            }
        }
    }
}
