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
        $this->form_validation->set_rules('zone', 'Zone', 'required');
        $this->form_validation->set_rules('task', 'Task', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('estate/add_work');
        } else {
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
                $colour = "table-success";
            } elseif ($_POST['task'] == 'pesticide') {
                $colour = "table-warning";
            } elseif ($_POST['task'] == 'weedicide') {
                $colour = "bg-danger";
            } elseif ($_POST['task'] == 'harvest') {
                $colour = "bg-success";
            } elseif ($_POST['task'] == 'weeding') {
                $colour = "bg-warning";
            } elseif ($_POST['task'] == 'prune') {
                $colour = "bg-info";
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
        if (strtotime($start_date) > strtotime($end_date)) {
            $this->session->set_flashdata('error', 'The start date cannot be earlier than the end date');
            $this->manage_estate();
        } else {
        //calls the model estate_history with the start and end dates, and sets the return as index result in array data
        $data["result"] = $this->estate_model->estate_history($start_date, $end_date);
        //pass the start and end dates to the array data
        $data["start_date"] = $start_date;
        $data["end_date"] = $end_date;
        //load view with array data
        $this->load->view('estate/view_history', $data);
        }
    }
    public function one_day_report()
    {
        //standard message handling
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }


        if (isset($_POST["date"])) {
            $data["date"] = date("Y-m-d", strtotime($_POST['date']));;
        } else {
            $data["date"] =  date("Y-m-d");
        }

        $data["work_done"] = $this->estate_model->ODR_estate($data["date"]);
        $data["weather"] = $this->estate_model->ODR_weather($data["date"]);
        $data["attendance"] = $this->estate_model->ODR_attendance($data["date"]);
        $data["worker"] = $this->estate_model->ODR_worker();
        $data["fin_info"] = $this->estate_model->ODR_fin_info($data["date"]);
        $data["fin_types"] = $this->estate_model->ODR_fin_types();
        $data["fin_current"] = $this->estate_model->ODR_fin_current();
        $data["chem_info"] = $this->estate_model->ODR_chem_info($data["date"]);
        $data["chem_types"] = $this->estate_model->ODR_chem_types();
        $data["suppliers"] = $this->estate_model->ODR_suppliers();

        $this->load->view('estate/one_day_report', $data);
    }
    public function weather()
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
        $date = date('Y-m-d');
        if ($this->estate_model->check_weather_data($date)) {
            $this->session->set_flashdata('error', 'Weather data for today has already been inserted');
            redirect('estate/manage_estate');
        } else {
            $data["current_date"] = date('Y-m-d');
            $this->load->view('estate/weather', $data);
        }
    }
    public function weather_submit()
    {
        $this->form_validation->set_rules('weather', 'Weather', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('estate/weather');
        } else {
            $weather_all = json_decode($_POST["weather"]);
            $weather = array();
            $weather["date"] = $weather_all->daily->time["0"];
            $weather["relative_humidity"] = $weather_all->current->relative_humidity_2m;
            $weather["max_temp"] = $weather_all->daily->temperature_2m_max["0"];
            $weather["min_temp"] = $weather_all->daily->temperature_2m_min["0"];
            $weather["daylight_duration"] = $weather_all->daily->daylight_duration["0"];
            $weather["rain_sum"] = $weather_all->daily->rain_sum["0"];
            $weather["max_wind_speed"] = $weather_all->daily->wind_speed_10m_max["0"];
            $weather["wind_direction"] = $weather_all->daily->wind_direction_10m_dominant["0"];
            if ($this->estate_model->insert_weather_data($weather)) {
                $this->session->set_flashdata('success', 'Weather data inserted successfully');
                redirect('estate/manage_estate');
            } else {
                $this->session->set_flashdata('error', 'Weather data was not inserted. Please try again');
                redirect('estate/weather');
            }
        }
    }
}
