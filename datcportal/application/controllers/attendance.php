<?php
Class Attendance extends CI_Controller {
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
		$this->load->model('course_model');
		$this->load->model('attendance_model');
		if($this->router->fetch_method() =='verification'){
			$this->session->set_userdata('current_menu', 'verification');
		}else{
			
			$this->session->set_userdata('current_menu', 'dashboard');
		}
		
	}  
	public function index() {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/attendance');
		}
		else{
			$this->load->view('login');
			
		}
	}


	public function x_week_range($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    return array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start)));
}


	/**
	 * attendance registration page 
	 * 
	 */

	public function newAttendanceRegistration($step=1){
		if($step == 1){
			$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
			$this->load->view('attendance-registration',$data);
		}elseif ($step == 2) {


			// print_r($_POST);
			if($this->session->userdata['user_detail']['type'] == 'admin' || $this->session->userdata['user_detail']['type'] == 'coordinator'){
			$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			 
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
			
			}elseif ($this->session->userdata['user_detail']['type'] == 'trainer') {
				$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			 
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
			// print_r($data['active_batches']);
			// print_r($this->session->userdata['user_detail']['user_id']);
			$trainer_assign_batches = $this->trainer_model->get_trainer_batch_details($this->session->userdata['user_detail']['user_id']);
				// print_r($trainer_assign_batches);
				foreach ($data['active_batches'] as $active_batch_key => $ative_batches) {
					$flag='false';

					if(is_array($trainer_assign_batches)){

						foreach ($trainer_assign_batches as $key => $trainer_batch) {
						// print_r($trainer_batch);
							if($ative_batches->batch_id == $trainer_batch->batch_id){
								$flag = 'true';

								break;
							}
						}
						// remove un match batch
						if($flag == 'false'){
							unset($data['active_batches'][$active_batch_key]);
						}

					}
					// remove un match batch
					if($flag == 'false'){
						unset($data['active_batches'][$active_batch_key]);
					}


				}
			}

			$this->load->view('attendance-registration',$data);
		}elseif ($step == 3) {
			// print_r($_POST);
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['select_batch_detail'] = $this->user_model->read_batch_byid($_POST['selectbatch'])[0];
			$data['student_in_batch_obj'] = $this->attendance_model->get_students_by_batch_id($_POST['selectbatch']);

			$data['trainer_in_batch_obj'] = $this->attendance_model->get_trainer_by_batch_id($_POST['selectbatch']);

				if(	!is_object($data['trainer_in_batch_obj'])){
					$data['error_message_display'] = "No active trainer found";
						// $this->load->view('attendance-registration',$data);
				}
			// print_r($data['student_in_batch_obj']);
			// print_r($data);
					if(	$data['student_in_batch_obj'] == 0){
						$data['error_message_display'] = "No student register yet";
						$this->load->view('attendance-registration',$data);
					}else{
						// get start and end date range in current week
					list($start_date, $end_date) = $this->x_week_range(date("Y-m-d"));
					$data['start_date'] = $start_date;
					$data['end_date'] = $end_date;
					$this->load->view('attendance-registration',$data);
					//  print_r($data);
					}
		}else if($step == 4){
			$students_obj = $this->attendance_model->get_students_by_batch_id($_POST['batch_id']);
			$trainer_obj = $this->user_model->trainer_map_to_batch($_POST['batch_id']);
			// print_r($trainer_obj);
			list($start_date, $end_date) = $this->x_week_range(date("Y-m-d"));
			$datetime = new DateTime($start_date);
				for($i=1; $i<=7; $i++){
					$index = 't_'.$trainer_obj->trainer_id.'_'.$i;
					if($_POST[$index] != 'na'){
						$data = array(
							'trainer_id' => $trainer_obj->trainer_id,
							'batch_id' => $trainer_obj->batch_id,
							'status' => $_POST[$index],
							'attend_date' => $datetime->format('Y-m-d'),
							'added_date' => Date('Y-m-d'),
							'staff_id' => $this->session->userdata('user_detail')['user_id']
						);
						$datetime->modify('+1 day');
						$datetime->format('Y-m-d');
						$this->attendance_model->trainer_add_new_attendance($data);
					}else{
						$datetime->modify('+1 day');
							$datetime->format('Y-m-d');
					}
				}
			// print_r($students_obj);
			list($start_date, $end_date) = $this->x_week_range(date("Y-m-d"));
		
			foreach ($students_obj as $key => $student) {
				$datetime = new DateTime($start_date);
				for($i=1; $i<=7; $i++){
					
					$index = $student->student_id.'_'.$i;
					 
						if($_POST[$index] != 'na'){
							//echo $_POST[$index];
							$data = array(
								'student_id' => $student->student_id,
								'batch_id' => $student->batch_id,
								'status' => $_POST[$index],
								'attend_date' => $datetime->format('Y-m-d'),
								'added_date' => Date('Y-m-d'),
								'staff_id' => $this->session->userdata('user_detail')['user_id']
							);
							$datetime->modify('+1 day');
							$datetime->format('Y-m-d');
							// print_r($data);
							$this->attendance_model->add_new_attendance($data);
						}else{
							$datetime->modify('+1 day');
							$datetime->format('Y-m-d');
						}
						

						// print_r($data);
				}
				
			}
			$data['success_message_display'] = "Batch attendance added successfully";
			
			 $data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
			 $this->load->view('attendance-registration',$data);
			

		}
		
	}
	
/**
	 * batchwise attendance search  
	 * 
	 */

	public function searchAttendance($step=1){
		if($step == 1){
			$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
			$this->load->view('attendance-view',$data);
		}elseif ($step == 2) {
			// print_r($_POST);

			if($this->session->userdata['user_detail']['type'] == 'admin' || $this->session->userdata['user_detail']['type'] == 'coordinator'){
				$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			 
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
			}elseif ($this->session->userdata['user_detail']['type'] == 'trainer') {

				$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			 
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
			// print_r($data['active_batches']);
			// print_r($this->session->userdata['user_detail']['user_id']);
			$trainer_assign_batches = $this->trainer_model->get_trainer_batch_details($this->session->userdata['user_detail']['user_id']);
				// print_r($trainer_assign_batches);
				foreach ($data['active_batches'] as $active_batch_key => $ative_batches) {
					$flag='false';

					if(is_array($trainer_assign_batches)){

						foreach ($trainer_assign_batches as $key => $trainer_batch) {
						// print_r($trainer_batch);
							if($ative_batches->batch_id == $trainer_batch->batch_id){
								$flag = 'true';
								
								// print_r($trainer_batch->batch_id);
								break;
							}
						}
						// remove un match batch
						if($flag == 'false'){
							unset($data['active_batches'][$active_batch_key]);
						}

					}
					// remove un match batch
					if($flag == 'false'){
						unset($data['active_batches'][$active_batch_key]);
					}


				}
				//  print_r($data['active_batches']);

				
			}
			
			 $this->load->view('attendance-view',$data);


		}elseif ($step == 3) {
			// print_r($_POST);
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['select_batch_detail'] = $this->user_model->read_batch_byid($_POST['selectbatch'])[0];
			$data['batch_attendance'] = $this->attendance_model->read_batchwise_attendance($_POST['selectbatch']);
			$data['batch_student_attendance'] = $this->attendance_model->get_students_by_batch_id($_POST['selectbatch']);
			$data['batch_trainer_attendance'] = $this->attendance_model->get_trainer_by_batch_id($_POST['selectbatch']);

					 $this->load->view('attendance-view',$data);
			// print_r($data);
		}
		
	}


	/**
 * search trainer base on the text send
 */
public function searchCourse(){
	// show default student search page
	if(isset($_POST['search-text']) && isset($_POST['type'])){
		// print_r($_POST);
		$course_search_result = $this->search_model->search_course($_POST);
		// print_r($student_search_result);
		// if found students
		if($course_search_result == 0){
			$data = array(
				'error_message_display'  => 'No result found',
				'search_input' => $_POST
			);
			$this->load->view('search-search-view',$data);
		}else{
			$data = array(
				'success_message_display' => 'Found result',
				'search_result' => $course_search_result,
				'search_input' => $_POST
			);
			$this->load->view('course-search-view',$data);
		}

	}else{
		$this->load->view('course-search-view');
	}
 }




 
}
?>
