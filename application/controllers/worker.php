<?php

class worker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->model('worker_model');
        date_default_timezone_set("Asia/colombo");
        $this->load->library("pagination");
        //User must be logged in to access any functions in this controller
        $this->checkSessionExist();
    }

    public function manage_worker()
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
        $this->load->view('worker/manage_workers', $data);
    }

    public function register_worker()
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
        $this->load->view('worker/register_worker', $data);
    }

    public function mark_attendance()
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
        if ($this->worker_model->check_if_attendance()) {
            $data['info'] = "Attendance has already been marked for today";
        }
        $data['date'] = date('Y-m-d');
        $attendance = $this->worker_model->attendance();
        $data['attendance'] = $attendance;
        $this->load->view('worker/mark_attendance', $data);
    }

    public function register_worker_Submit()
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('dob', 'Date of birth', 'required');
        $this->form_validation->set_rules('emp_status', 'Employment Status', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('education', 'Education Status', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'All Fields are required');
            redirect("worker/register_worker");
        } else {
            // associative array
            $data = array(
                'worker_id' => NULL,
                'name' => $_POST['name'],
                'dob' => $_POST['dob'],
                'emp_status' => $_POST['emp_status'],
                'wage' => $_POST['wage'],
                'gender' => $_POST['gender'],
                'education' => $_POST['education'],
                'address' => $_POST['address']
            );

            if ($data['emp_status'] == "permanent") {
                $data = array_merge(
                    $data,
                    array(
                        'EPF' => $_POST['EPF'],
                        'EPF_no' => $_POST['EPF_no'],
                        'ETF' => $_POST['ETF'],
                        'ETF_no' => $_POST['ETF_no']
                    )
                );
            }
            echo ($data['dob']);
            $data['dob'] = date("Y-m-d", strtotime($data['dob']));

            $result = $this->worker_model->registerworker($data);
            if ($result) {
                $data = array(
                    'success' => 'Worker Registered Sucessfully'
                );
                $this->load->view('worker/manage_workers', $data);
            } else {
                $data = array(
                    'error' => 'Worker is already registred'
                );
                $this->load->view('worker/register_worker', $data);
            }
        }
    }

    public function attendanceSubmit()
    {
        print_r($_POST);
        $currentdate = date('Y-m-d');
        foreach ($_POST as $key => $value) {
            if ($value == 'Submit') {
                break;
            } else {
                if ($value == NULL) {
                    $this->session->set_flashdata('error', 'Attendance cannot be empty');
                    redirect("worker/mark_attendance");
                }
            }
        }

        $i = $result = 0;
        foreach ($_POST as $key => $value) {
            if ($value == 'Submit') {
                break;
            } else {
                $worker_id = mb_substr($key, -1);
                $data = array(
                    'worker_id' => $worker_id,
                    'date' => $currentdate,
                    'status' => $value

                );
                print_r($data);
                if ($this->worker_model->attendance_Submit($data)) {
                    $result = $result + 1;
                }
                $i = $i + 1;
            }
        }

        printf($i);
        printf($result);
        if ($result == $i) {
            $this->session->set_flashdata('success', 'Attendance marked successfully');
            redirect("worker/manage_worker");
        } else {
            $this->session->set_flashdata('error', 'An error occured. Please try again');
            redirect("worker/mark_attendance");
        }
    }


    public function view_worker($offset = 0)
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
        $config["base_url"] = base_url() . "worker/view_worker";
        $config["total_rows"] = $this->worker_model->get_count();
        $config["per_page"] = 1;

        //Encapsulate whole pagination    
        $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul>';

        //First link of pagination
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';

        //Customizing the “Digit” Link
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        //For PREVIOUS PAGE Setup
        $config['prev_link']        = 'Prev';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';

        //For LAST PAGE Setup
        $config['last_link']        = 'Last';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';

        //For NEXT PAGE Setup
        $config['next_link']        = 'Next';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';


        $config['attributes']       = ['class' => 'page-link'];


        //For CURRENT page on which you are
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';



        // 
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
        $data['items'] = $this->worker_model->get_paginantion_users($config["per_page"], $offset);;
        // $result = $this->product_model->getAllProducts();
        // $products['items'] =  $result;
        $this->load->view('worker/view_worker', $data);
    }

    public function editworker($id)
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

        $result = $this->worker_model->getworkerDataByID($id);
        if ($result) {
            $data['workerdata'] = $result;
            $this->load->view('worker/edit_worker', $data);
        }
    }
    public function editworkerSubmit()
    {
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Form details cannot be empty');
            redirect("/worker/editworker/{$_POST['worker_id']}");
        } else {
            print_r($_POST);
            $data = array(
                'worker_id' => $_POST['worker_id'],
                'name' => $_POST['name'],
                'dob' => $_POST['dob'],
                'emp_status' => $_POST['emp_status'],
                'wage' => $_POST['wage'],
                'EPF' => $_POST['EPF'],
                'EPF_no' => $_POST['EPF_no'],
                'ETF' => $_POST['ETF'],
                'ETF_no' => $_POST['ETF_no'],
                'gender' => $_POST['gender'],
                'education' => $_POST['education'],
                'address' => $_POST['address']
            );
            $result = $this->worker_model->updateworker($data);
            if ($result == 1) {
                $this->session->set_flashdata('success', 'Profile data updated successfully');
                redirect("/worker/manage_worker/");
            } elseif ($result == 0) {
                $this->session->set_flashdata('success', 'Profile data upto date');
                redirect("/worker/manage_worker/");
            } else {
                $this->session->set_flashdata('error', 'Error occured Please try again');
                redirect("/worker/editworker/{$_POST['worker_id']}");
            }
        }
    }
    public function deleteworker($id)
    {
        $worker_data = $this->worker_model->getworkerDataByID($id);
        $data['result'] = $worker_data;
        $this->load->view('worker/delete_confirmation', $data);
    }
    public function deleteworker_confirmation($id)
    {
        $result = $this->worker_model->deleteworker($id);
        if ($result == 1) {
            $this->session->set_flashdata('success', 'Worker marked for deletion successfully. Data will be removed later');
            redirect("/worker/manage_worker/");
        } elseif ($result == 0) {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again');
            redirect("/worker/manage_worker/");
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
    public function for_deletion()
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
        if (false == $this->worker_model->for_deletion()) {
            $data['error'] = "No workers are marked for deletion";
        }

        $result = $this->worker_model->for_deletion();
        $data['result'] = $result;
        $this->load->view('worker/for_deletion', $data);
    }
    public function perm_delete_worker($id)
    {
        $worker_data = $this->worker_model->getworkerDataByID($id);
        $data['result'] = $worker_data;
        $this->load->view('worker/perm_delete_confirmation', $data);
    }
    public function perm_deleteworker_confirmation($id)
    {
        $result = $this->worker_model->perm_deleteworker($id);
        if ($result == 1) {
            $this->session->set_flashdata('success', 'Worker data removed');
            redirect("/worker/manage_worker/");
        } elseif ($result == 0) {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again');
            redirect("/worker/manage_worker/");
        }
    }
    public function restore_worker($id)
    {
        $result = $this->worker_model->restore_worker($id);
        if ($result == 1) {
            $this->session->set_flashdata('success', 'Worker restored sucessfully');
            redirect("/worker/manage_worker/");
        } elseif ($result == 0) {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again');
            redirect("/worker/manage_worker/");
        }
    }
    public function search_worker()
    {
        $query = $this->input->post('query');
        $results = $this->worker_model->get_results($query);
        echo json_encode($results);
    }

    public function view_attendance($start_date = NULL, $end_date = NULL)
    {
        //standard message handaling
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
            $start_date = date("Y-m-d", strtotime($_POST["start_date"]));
        } else {
            $start_date = date_format(date_sub(date_create(date("Y-m-d")), date_interval_create_from_date_string("7 day")), "Y-m-d");
        }
        if (isset($_POST["end_date"])) {
            $end_date = date("Y-m-d", strtotime($_POST["end_date"]));
        } else {
            $end_date = date("Y") . "-" . date("m") . "-" . date("d");
        }
        //calls the model estate_history with the start and end dates, and sets the return as index result in array data
        $data["result"] = $this->worker_model->attendance_history($start_date, $end_date);
        //pass the start and end dates to the array data
        $data["start_date"] = $start_date;
        $data["end_date"] = $end_date;

        $data['worker'] = $this->worker_model->getworkerData();
        //load view with array data
        $this->load->view('worker/view_attendance', $data);
    }
}
