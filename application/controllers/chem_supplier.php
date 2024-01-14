<?php

class chem_supplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->model('chem_supplier_model');
        date_default_timezone_set("Asia/colombo");
        $this->checkSessionExist();
        $this->load->helper('array');
    }

    public function manage_suppliers()
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
        $this->load->view('chemicals/suppliers/manage_suppliers', $data);
    }

    public function add_supplier()
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
        $this->load->view('chemicals/suppliers/add_supplier', $data);
    }
    public function add_supplier_submit()
    {
        $data = array(
            'supplier_id' => NULL,
            'name' => $_POST["name"],
            'address' => $_POST['address'],
            'status' => TRUE

        );

        if ($this->chem_supplier_model->add_supplier($data)) {
            $this->session->set_flashdata('success', 'Supplier Added Successfully');
            redirect('chem_supplier/manage_suppliers');
        } else {
            $this->session->set_flashdata('error', 'Supplier Failed to Add. Please try again');
            redirect('chem_supplier/add_suppliers');
        }
    }

    public function view_suppliers()
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
        $data["result"] = $this->chem_supplier_model->get_suppliers();
        $this->load->view('chemicals/suppliers/view_suppliers', $data);
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
    public function edit_supplier($id)
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

        $result = $this->chem_supplier_model->get_Supplier_Data_By_ID($id);
        if ($result) {
            $data['result'] = $result;
            $this->load->view('chemicals/suppliers/edit_supplier', $data);
        }
    }
    public function edit_supplier_submit()
    {
        print_r($_POST);
        $data = array(
            'supplier_id' => $_POST['supplier_id'],
            'name' => $_POST["name"],
            'address' => $_POST['address']

        );
        $result = $this->chem_supplier_model->edit_supplier($data);
        if ($result == 1) {
            $this->session->set_flashdata('success', 'Supplier Edited Successfully');
            redirect('chem_supplier/manage_suppliers');
        } elseif ($result == 0) {
            $this->session->set_flashdata('success', 'No Data Changed');
            redirect('chem_supplier/manage_suppliers');
        } else {
            $this->session->set_flashdata('error', 'Supplier Failed to Edit. Please try again');
            redirect('chem_supplier/manage_suppliers');
        }
    }

    public function delete_supplier($id)
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

        $result = $this->chem_supplier_model->get_Supplier_Data_By_ID($id);
        if ($result) {
            $data['result'] = $result;
            $this->load->view('chemicals/suppliers/delete_confirmation', $data);
        }
    }

    public function delete_supplier_confirmation($id)
    {
        if ($this->chem_supplier_model->delete_supplier($id)) {
            $this->session->set_flashdata('success', 'Supplier Deleted Successfully');
        } else {
            $this->session->set_flashdata('error', 'Chemical Failed to Delete. Please try again');
        }
        redirect('chem_supplier/manage_suppliers');
    }
}
