<?php
Class Trainer extends CI_Controller {
    public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		//load url library
		$this->load->helper('url');

		// Load Models
		$this->load->model('user_model');
		$this->load->model('search_model');
		$this->load->model('trainer_model');
		if($this->router->fetch_method() =='verification'){
			$this->session->set_userdata('current_menu', 'verification');
		}else{
			
			$this->session->set_userdata('current_menu', 'dashboard');
		}
		
	}  
	public function index() {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/studentTrainerDashBoard');
		}
		else{
			$this->load->view('login');
			
		}
	}
	/**
	 * view traner registration page 
	 * 
	 */
	public function newTrainerRegistration(){
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if(!empty($success)){
			$data['success_message_display'] = $success;
			
		}
		if(!empty($error)){
			$data['error_message_display'] = $error;
			
		}
		if(isset($data)){
			$this->load->view('trainer-registration',$data);
		}else{
			$this->load->view('trainer-registration');
		}
		
	}
	public function addNewTrainer()
	{
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
		
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('trainer-registration');
			}else{

				$data_trainer = array(
					'first_name' => $this->input->post('firstname'),
					'last_name' => $this->input->post('lastname'),
					'birth_date' => $this->input->post('bdate'),
					'email' => $this->input->post('email'),
					'password' => sha1($this->input->post('password')),
					'state' => 'active',
					'register_date' => Date('Y-m-d'),
		
				);
				
				$result_registration = $this->trainer_model->add_new_trainer($data_trainer);
				if($result_registration == 1){
		
		
					$this->session->set_flashdata('success_message_display','Trainer registered successfully');
						redirect('/trainer/newTrainerRegistration');
					
				}else{
					$data['error_message_display'] = "Registration Fail";
					$this->load->view('trainer-registration',$data);
		
					$this->session->set_flashdata('error_message_display','Registration Fail. Try again.');
						redirect('/trainer/newTrainerRegistration');
				}

			}
	


	}

	/**
	 * get active trainer detials
	 * get course
	 * get active batch detials of a course
	 * 
	 */

	public function trainerBatch($step=1){
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if(!empty($success)){
			$data['success_message_display'] = $success;
			
		}
		if(!empty($error)){
			$data['error_message_display'] = $error;
			
		}
		$active_courses= $this->user_model->read_all_active_courses();
		$active_trainers = $this->trainer_model->get_all_trainers_base_state('active');
		if($step == 1){
			if($active_courses && $active_trainers){
				// print_r($active_courses);
				$data['active_courses'] = $active_courses;
				$data['active_trainers'] = $active_trainers;
	
				$this->load->view('trainer-batch-map',$data);
			}
		}else if($step == 2){
			$data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course'])[0];
			
			$data['select_trainer'] = $this->trainer_model->get_trainer_by_id($_POST['trainer_id'])[0];
			// $data['course_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			$course_batches = $this->user_model->read_active_batch($_POST['selected_course']);
			foreach ($course_batches as $key => $value) {
				// print_r($value);
				
				$course_batches[$key]->trainer_details = $this->user_model->trainer_map_to_batch($value->batch_id);
			}
			// print_r($course_batches);
			$data['course_batches'] = $course_batches;
			$this->load->view('trainer-batch-map',$data);
		}else if($step == 3){
			
			$data = array(
				'trainer_id' => $_POST['trainer_id'],
				'batch_id' => $_POST['select_batch'],
				'staff_id' => $this->session->userdata('user_detail')['user_id'],
				'added_date' => Date('Y-m-d'),
				'state' => 'active'

			);
			$result = $this->trainer_model->map_trainer_with_batch($data);
			// echo $result;
			if($result == 1){
				$this->session->set_flashdata('success_message_display','Trainer assigned to batch');
				redirect('/trainer/trainerBatch/1');
			}else if($result == '2'){
				$this->session->set_flashdata('success_message_display','Trainer state update to active');
				redirect('/trainer/trainerBatch/1');
			}else{
				$this->session->set_flashdata('error_message_display','Error came when assigning trainer to batch. Please try again');
				redirect('/trainer/trainerBatch/1');

			}
		}
		
	}
	/**
 * search trainer base on the text send
 */
public function searchTrainer(){
	// show default student search page
	if(isset($_POST['search-text']) && isset($_POST['type'])){
		// print_r($_POST);
		$trainer_search_result = $this->search_model->search_trainer($_POST);
		// print_r($student_search_result);
		// if found students
		if($trainer_search_result == 0){
			$data = array(
				'error_message_display'  => 'No result found',
				'search_input' => $_POST
			);
			$this->load->view('trainer-search-view',$data);
		}else{
			$data = array(
				'success_message_display' => 'Found result',
				'search_result' => $trainer_search_result,
				'search_input' => $_POST
			);
			$this->load->view('trainer-search-view',$data);
		}

	}else{
		$this->load->view('trainer-search-view');
	}
 }

 public function trainerProfile($trainerid){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	if(isset($trainerid)){

	 $trainer_details = $this->trainer_model->get_trainer_by_id($trainerid);
	 $trainer_batches_object = $this->trainer_model->get_trainer_batch_details($trainerid);

	//  print_r($trainer_details);
	//  print_r($trainer_batches_object);
	 if($trainer_batches_object != 0){
		$data['trainer_profile'] = $trainer_details;
	 	$data['trainer_batches_object'] = $trainer_batches_object;
	 	$this->load->view('trainer-profile',$data);
	 }else{
		$data['trainer_profile'] = $trainer_details;
		$data['trainer_batches_object'] = $trainer_batches_object;
		$this->load->view('trainer-profile',$data);
		
	 }
	 
	}else{
		$data['errow_message_display'] = 'invalid input of trainer';
		$this->load->view('trainer-search-view',$data);
	}
 }

 public function trainerProfileUpdate(){
	 print_r($_POST);

	 $data = array(
		'trainer_id'=>$_POST['trainerid'], 
		'first_name'=>$_POST['fname'],
		'last_name'=>$_POST['lname'],
		'birth_date'=>$_POST['bdate'],
		'email'=>$_POST['email'],
		'state'=>$_POST['studentstate'],
	);

	$result = $this->trainer_model->trainerUpdate($data);
	if($result == 1){
		$this->session->set_flashdata('success_message_display','Student batch details update successfully');
		redirect('/trainer/trainerProfile/'.$data['trainer_id']);
	}else if($result == 0){
		$this->session->set_flashdata('success_message_display','All upto date');
		redirect('/trainer/trainerProfile/'.$data['trainer_id']);
	}else{
		$this->session->set_flashdata('error_message_display','Error occoured try again');
		redirect('/trainer/trainerProfile/'.$data['trainer_id']);
	}


 }
}
?>
