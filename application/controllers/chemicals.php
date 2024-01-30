<?php

class chemicals extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->model('chemicals_model');
        date_default_timezone_set("Asia/colombo");
        $this->checkSessionExist();
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->helper('array');
    }

    public function manage_chemicals()
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
        $this->load->view('chemicals/manage_chemicals', $data);
    }

    public function add_chemicals()
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
        $this->load->view('chemicals/add_chemical', $data);
    }
    public function add_chemical_submit()
    {
        $data = array(
            'chem_id' => NULL,
            'name' => $_POST["name"],
            'type' => $_POST['type'],
            'description' => $_POST['description'],

        );

        if ($this->chemicals_model->add_chemical($data)) {
            $this->session->set_flashdata('success', 'Chemical Added Successfully');
            redirect('chemicals/manage_chemicals');
        } else {
            $this->session->set_flashdata('error', 'Chemical Failed to Add. Please try again');
            redirect('chemicals/add_chemicals');
        }
    }

    public function view_chemicals()
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
        $data["result"] = $this->chemicals_model->get_chemicals();
        $this->load->view('chemicals/view_chemicals', $data);
    }

    public function purchase_chemicals()
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
        $data["chemicals"] = $this->chemicals_model->get_chemicals();
        $data["suppliers"] = $this->chemicals_model->get_suppliers();
        $this->load->view('chemicals/chemicals_purchase', $data);
    }

    public function add_chemicals_submit()
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
        print_r($_POST);

        $current_chem_data = array(
            'chem_id' => $_POST['chem_id'],
            'amount' => $_POST['amount'],
            'cost' => $_POST['cost']
        );
        $in_chem_data = array(
            'chem_id' => $_POST['chem_id'],
            'date' => $currentdate,
            'amount' => $_POST['amount'],
            'cost' => $_POST['cost'],
            'supplier' => $_POST['supplier_id']
        );

        if ($this->chemicals_model->update_current_chemicals($current_chem_data, $_POST['supplier_id'])) {
            if ($this->chemicals_model->chemicals_in($in_chem_data)) {
                $this->session->set_flashdata('success', 'Transaction recorded Sucessfully');
                redirect('chemicals/manage_chemicals');
            } else {
                $this->session->set_flashdata('error', 'Tranaction failed. Please try again');
                redirect('chemicals/add_chemicals');
            }
        } else {
            $this->session->set_flashdata('error', 'Tranaction failed. Please try again');
            redirect('chemicals/add_chemicals');
        }
    }
    public function consume_chemicals()
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
        $data["chemicals"] = $this->chemicals_model->get_chemicals();
        $this->load->view('chemicals/chemicals_consumption', $data);
    }
    public function consume_chemicals_submit()
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
        $data = array(
            'chem_id' => $_POST['chem_id'],
            'date' => date('Y-m-d'),
            'amount' => $_POST['amount']
        );
        if ($this->chemicals_model->chemicals_out($data)) {
            $this->session->set_flashdata('success', 'Transaction recorded Sucessfully');
            redirect('chemicals/manage_chemicals');
        } else {
            $this->session->set_flashdata('error', 'Tranaction failed. Please try again');
            redirect('chemicals/consume_chemicals');
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
    public function editchemical($id)
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

        $result = $this->chemicals_model->getChemicalDataByID($id);
        if ($result) {
            $data['result'] = $result;
            $this->load->view('chemicals/edit_chemical', $data);
        }
    }
    public function editChemicalSubmit()
    {
        print_r($_POST);
        $data = array(
            'chem_id' => $_POST["chem_id"],
            'name' => $_POST["name"],
            'type' => $_POST['type'],
            'description' => $_POST['description'],

        );

        if ($this->chemicals_model->edit_chemical($data)) {
            $this->session->set_flashdata('success', 'Chemical Edited Successfully');
            redirect('chemicals/manage_chemicals');
        } else {
            $this->session->set_flashdata('error', 'Chemical Failed to Edit. Please try again');
            redirect('chemicals/editchemical');
        }
    }
    public function deletechemical($id)
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

        $result = $this->chemicals_model->getChemicalDataByID($id);
        if ($result) {
            $data['result'] = $result;
            $this->load->view('chemicals/delete_confirmation', $data);
        }
    }

    public function deletechemical_confirmation($id)
    {
        if ($this->chemicals_model->delete_chemical($id)) {
            $this->session->set_flashdata('success', 'Chemical Edited Successfully');
            redirect('chemicals/manage_chemicals');
        } else {
            $this->session->set_flashdata('error', 'Chemical Failed to Edit. Please try again');
            redirect('chemicals/chemical');
        }
    }
    public function view_history($start_date = NULL, $end_date = NULL)
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
        $currentdate = date("Y-m-d");
        if (isset($_POST["start_date"])) {
            $formated_date = date_create($_POST["start_date"]);
            $start_date = date_format($formated_date, "Y-m-d");
        } else {
            $formated_date = date_create($currentdate);
            date_add($formated_date, date_interval_create_from_date_string("-7 day"));
            $start_date = date_format($formated_date, "Y-m-d");
        }
        if (isset($_POST["end_date"])) {
            $formated_date = date_create($_POST["end_date"]);
            $end_date = date_format($formated_date, "Y-m-d");
        } else {
            $end_date = $currentdate;
        }
        //calls the model estate_history with the start and end dates, and sets the return as index result in array data
        $data["result"] = $this->chemicals_model->chemical_history($start_date, $end_date);
        $data["chemicals"] = $this->chemicals_model->get_chemicals();
        $data["suppliers"] = $this->chemicals_model->get_suppliers();
        //pass the start and end dates to the array data
        $data["start_date"] = $start_date;
        $data["end_date"] = $end_date;
        //load view with array data
        $this->load->view('chemicals/view_history', $data);
    }
}