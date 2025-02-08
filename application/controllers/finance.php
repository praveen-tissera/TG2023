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
        $this->load->library('pagination');
        $this->load->helper('array');
        $this->load->helper('url');
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
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('finance/add_expense');
        } else {
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
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('type_id', 'Type', 'required');
        $this->form_validation->set_rules('source', 'Source', 'required');
        $this->form_validation->set_rules('comments', 'Comment', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->expense();
        } else {
            if (isset($_FILES["expense_reference"]['name'])) {
                $currentdate = date('Y-m-d');
                $new_name = time() . $_FILES["expense_reference"]['name'];
                $new_name = preg_replace('/\s+/', '', $new_name);
                $config = array(
                    'upload_path' => './uploads/image/expense/',
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    // 'max_height' => "768",
                    // 'max_width' => "1024",
                    'file_name' => $new_name
                );
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload("expense_reference")) {
                    $data = array('upload_data' => $this->upload->data());
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error);
                    redirect('finance/expense');
                }

                $data = array(
                    'date' => $currentdate,
                    'amount' => $_POST["amount"],
                    'type_ID' => $_POST["type_id"],
                    'source' => $_POST["source"],
                    'comments' => $_POST['comments'],
                    'image' => $new_name
                );

                if ($this->finance_model->add_expense($data)) {
                    $bal = $this->finance_model->get_bal($_POST["source"]);
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
            } else {
                $this->session->set_flashdata('error', 'Expense reference is required');
                $this->expense();
            }
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
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('finance/add_income');
        } else {
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
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('type_id', 'Type', 'required');
        $this->form_validation->set_rules('source', 'Source', 'required');
        $this->form_validation->set_rules('comments', 'Comment', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->income();
        } else {
            if (isset($_FILES["income_reference"]['name'])) {
                $currentdate = date('Y-m-d');

                $new_name = time() . $_FILES["income_reference"]['name'];
                $new_name = preg_replace('/\s+/', '', $new_name);
                $config = array(
                    'upload_path' => './uploads/image/income/',
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'file_name' => $new_name
                );
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload("income_reference")) {
                    $data = array('upload_data' => $this->upload->data());
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('finance/expense');
                }


                $data = array(
                    'date' => $currentdate,
                    'amount' => $_POST["amount"],
                    'type_ID' => $_POST["type_id"],
                    'source' => $_POST["source"],
                    'comments' => $_POST['comments'],
                    'image' => $new_name

                );

                if ($this->finance_model->add_income($data)) {
                    $bal = $this->finance_model->get_bal($_POST["source"]);
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
            } else {

                $this->session->set_flashdata('error', 'Income reference is required');
                $this->income();
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

    public function view_tran_history($start_date = NULL, $end_date = NULL)
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
            date_sub($formated_date, date_interval_create_from_date_string("7 day"));
            $start_date = date_format($formated_date, "Y-m-d");
        }
        if (isset($_POST["end_date"])) {
            $formated_date = date_create($_POST["end_date"]);
            $end_date = date_format($formated_date, "Y-m-d");
        } else {
            $end_date = $currentdate;
        }
        if (strtotime($start_date) > strtotime($end_date)) {
            $this->session->set_flashdata('error', 'The end date cannot be earlier than the start date');
            $this->manage_finance();
        } else {
            //calls the model estate_history with the start and end dates, and sets the return as index result in array data
            $data["result"] = $this->finance_model->tran_history($start_date, $end_date);
            $data["incomes"] = $this->finance_model->get_income_types();
            $data["expenses"] = $this->finance_model->get_expense_types();
            $data["current"] = $this->finance_model->get_balance_types();
            //pass the start and end dates to the array data
            $data["start_date"] = $start_date;
            $data["end_date"] = $end_date;
            //load view with array data
            $this->load->view('finance/view_tran_history', $data);
        }
    }
    public function view_current()
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
        $data["result"] = $this->finance_model->get_balance_types();
        $this->load->view('finance/view_current', $data);
    }
}
