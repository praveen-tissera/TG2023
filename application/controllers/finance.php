<?php

class finance extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->model('finance_model');
        date_default_timezone_set("Asia/colombo");
        $this->checkSessionExist();
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->helper('array');
    }

    public function manage_finance()
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
        $this->load->view('finance/manage_finance', $data);
    }

    public function add_expenses()
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
        $this->load->view('finance/add_expense', $data);
    }
    public function add_expense_type_submit()
    {
        $data = array(
            'type_ID' => NULL,
            'name' => $_POST["name"],
            'description' => $_POST['description']

        );

        if ($this->finance_model->add_expense_type($data)) {
            $this->session->set_flashdata('success', 'Expense type Added Successfully');
            redirect('finance/manage_finance');
        } else {
            $this->session->set_flashdata('error', 'Expense type Failed to Add. Please try again');
            redirect('finance/add_expenses');
        }
    }

    public function expense()
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
        $data["bal"] = $this->finance_model->get_balance_types();
        $data["result"] = $this->finance_model->get_expense_types();
        $this->load->view('finance/expense', $data);
    }

    public function expense_submit()
    {
        $currentdate = date('Y-m-d');
        $data = array(
            'date' => $currentdate,
            'amount' => $_POST["amount"],
            'type_ID' => $_POST["type_id"],
            'source' => $_POST["source"],
            'comments' => $_POST['comments']

        );

        if ($this->finance_model->add_expense($data)) {
            $bal = $this->finance_model->get_bal($_POST["source"]);
            echo (print_r($bal));
            $bal = $bal - $_POST["amount"];
            if ($this->finance_model->set_bal($_POST["source"], $bal)) {
                $this->session->set_flashdata('success', 'Expense Added Successfully');
                redirect('finance/manage_finance');
            } else {
                $this->session->set_flashdata('error', 'Expense Failed to Add. Please try again');
                redirect('finance/expense');
            }
        } else {
            $this->session->set_flashdata('error', 'Expense Failed to Add. Please try again');
            redirect('finance/expense');
        }
    }

    public function add_income_type()
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
        $this->load->view('finance/add_income', $data);
    }
    public function add_income_type_submit()
    {
        $data = array(
            'type_ID' => NULL,
            'name' => $_POST["name"],
            'description' => $_POST['description']

        );

        if ($this->finance_model->add_income_type($data)) {
            $this->session->set_flashdata('success', 'Income type Added Successfully');
            redirect('finance/manage_finance');
        } else {
            $this->session->set_flashdata('error', 'Income type Failed to Add. Please try again');
            redirect('finance/add_income_type');
        }
    }

    public function income()
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
        $data["bal"] = $this->finance_model->get_balance_types();
        $data["result"] = $this->finance_model->get_income_types();
        $this->load->view('finance/income', $data);
    }

    public function income_submit()
    {
        $currentdate = date('Y-m-d');
        $data = array(
            'date' => $currentdate,
            'amount' => $_POST["amount"],
            'type_ID' => $_POST["type_id"],
            'source' => $_POST["source"],
            'comments' => $_POST['comments']

        );

        if ($this->finance_model->add_income($data)) {
            $bal = $this->finance_model->get_bal($_POST["source"]);
            echo (print_r($bal));
            $bal = $bal + $_POST["amount"];
            if ($this->finance_model->set_bal($_POST["source"], $bal)) {
                $this->session->set_flashdata('success', 'Income Added Successfully');
                redirect('finance/manage_finance');
            } else {
                $this->session->set_flashdata('error', 'Balance Failed to set. Please try again');
                redirect('finance/income');
            }
        } else {
            $this->session->set_flashdata('error', 'Income Failed to Add. Please try again');
            redirect('finance/income');
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
