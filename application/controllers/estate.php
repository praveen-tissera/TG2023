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
        $this->load->library('upload');
		$this->load->library('pagination');
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

    public function add_work()
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
        $this->load->view('estate/add_work', $data);
    }

    public function add_work_submit()
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
        $currentdate = date('Y-m-d');

        $data = array(
            'date' => $currentdate,
            'id' => $_POST['zone'],
            'status' =>$_POST['task']

        );
        if($this->estate_model->insert_estate_data($data)){
            $this->session->set_flashdata('success', 'Work data inserted successfully');
            redirect('estate/manage_estate');
        }else{
            $this->session->set_flashdata('error', 'Work data was not inserted. Please try again');
            redirect('estate/add_work');
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
    public function view_history($offset = 0)
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
        
            $config = array();
            $config['base_url'] = base_url() . 'estate/view_history';
            $config['total_rows'] = $this->estate_model->get_count();
            $config['per_page'] = 10;
            //Ecapsulation pagination
            $config['full_tag_open'] = '<ul class="pagination justify-content-center';
            $config['full_tag_close'] = '</ul>';
            //First link
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            //Customizing the "Digit" Link
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            //previous page set up
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            //Last page
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            //Next page
            $config['next_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
    
    
            $config['attributes'] = ['class' => 'page-link'];
    
            //curent page
            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link >';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    
    
            $this->pagination->initialize($config);
    
    
            $data['links'] = $this->pagination->create_links();
            $data['items'] = $this->estate_model->estate_history($config['per_page'], $offset);
    
            $this->load->view('estate/view_history', $data);
        
    }
}
