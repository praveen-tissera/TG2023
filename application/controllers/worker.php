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

        $attendance = $this->worker_model->attendance();
        $data['attendance'] = $attendance;
        $this->load->view('worker/mark_attendance', $data);
    }

    public function register_worker_Submit()
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Name and Address are required');
            redirect("worker/register_worker");
        } else {
            // associative array
            $data = array(
                'worker_id' => NULL,
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
        //***foreach ($_POST as $key => $value) {
        //    if ($value->status == NULL) {
        //        $this->session->set_flashdata('error', 'Attendance cannot be empty');
        //        redirect("worker/mark_attendance");
        //    }
        //}
        $i = $result = 0;
        if ($this->worker_model->check_if_attendance()) {
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
                    if ($this->worker_model->attendance_Submit($data)) {
                        $result = $result + 1;
                    }
                    $i = $i + 1;
                }
            }
        } else {
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
                    if ($this->worker_model->attendance_Submit_unset($data)) {
                        $result = $result + 1;
                    }
                    $i = $i + 1;
                }
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


    public function view_worker()
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
        $result = $this->worker_model->getworkerData();
        $data['result'] = $result;
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
            $this->session->set_flashdata('success', 'Worker deleted successfully');
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
}
