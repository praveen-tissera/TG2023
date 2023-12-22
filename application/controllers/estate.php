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
        $this->load->helper('array');
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

        if ($_POST['task'] == 'fertilizer') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'pesticide') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'weedicide') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'harvest') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'weeding') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'prune') {
            $colour = "bg-primary";
        } elseif ($_POST['task'] == 'maintenance') {
            $colour = "bg-primary";
        }

        $data = array(
            'date' => $currentdate,
            'id' => $_POST['zone'],
            'status' => $_POST['task'],
            'colour' => $colour
        );
        if ($this->estate_model->insert_estate_data($data)) {
            $this->session->set_flashdata('success', 'Work data inserted successfully');
            redirect('estate/manage_estate');
        } else {
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
    public function view_history($start_date = NULL,$end_date = NULL)
    {
        //standard massage handaling
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
//checks if start and enddates are set
//if not, the date range of 1 week from the current date is set
        if (isset($_POST["start_date"])) {
            $start_date = $_POST["start_date"];
        } else {
            $start_date = date("Y") . "-" . date("m") . "-" . (date("d") - 7);
        }
        if (isset($_POST["end_date"])) {
            $end_date = $_POST["end_date"];
        } else {
            $end_date = date("Y") . "-" . date("m") . "-" . date("d");
        }
        //calls the model estate_history with the start and end dates, and sets the return as index result in array data
        $data["result"] = $this->estate_model->estate_history($start_date, $end_date);
        //pass the start and end dates to the array data
        $data["start_date"] = $start_date;
        $data["end_date"] = $end_date;
        //load view with array data
        $this->load->view('estate/view_history', $data);
    }
}
