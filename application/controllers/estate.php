<?php

class estate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->model('estate_model');
        date_default_timezone_set("Asia/colombo");
        $this->checkSessionExist();
    }

    public function manage_estate()
    {
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        $this->load->view('estate/manage_estate', $data);
    }


    
    public function editProfile($id)
    {
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        if ($this->checkSessionExist()) {

            $result = $this->user_model->getUserDataByID($id);
            if ($result) {
                $data['myprofile'] = $result;
                $this->load->view('edit-profile', $data);
            }
        }
    }

    public function editProfileSubmit()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Form details cannot be empty');
            redirect("/login/editProfile/{$_POST['userid']}");
        } else {
            print_r($_POST);
            $data = array(
                'id' => $_POST['userid'],
                'name' => $_POST['username'],
                'email' => $_POST['email'],
                'address' => $_POST['address']
            );
            $result = $this->user_model->updateProfile($data);
            if ($result == 1) {
                $this->session->set_flashdata('success', 'Profile data updated successfully');
                redirect("/user/profile/");
            } elseif ($result == 0) {
                $this->session->set_flashdata('success', 'Profile data upto date');
                redirect("/user/profile/");
            } else {
                $this->session->set_flashdata('error', 'Error occured Please try again');
                redirect("/user/editProfile/{$_POST['userid']}");
            }
        }
    }
    private function checkSessionExist()
    {
        if (!$this->session->has_userdata('userinfo')) {
            $this->session->set_flashdata('error', 'Please login first to access the page');
            redirect('login/userlogin');
        } else {
            return true;
        }
    }

    public function register()
    {
        $this->load->view('register');
    }

    public function worker()
    {
        redirect('worker/manage_worker');
    }

}
