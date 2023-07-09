<?php
Class Course extends CI_Controller {
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
		
	}  
	public function index() {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/course');
		}
		else{
			$this->load->view('login');
			
		}
	}
	/**
	 * view traner registration page 
	 * 
	 */
	public function newCourseRegistration(){
		
		$this->load->view('course-registration');
	}
	public function newBatchRegistration(){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		
		$this->load->view('batch-registration',$data);
	}
	public function addNewCourse(){

		$this->form_validation->set_rules('coursename', 'Course name', 'trim|required');
		$this->form_validation->set_rules('coursediscription', 'Course description', 'trim|required');
		$this->form_validation->set_rules('coursefee', 'Course fee', 'trim|required|numeric');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('course-registration');
		}else{



		$data_course = array(
			'course_name' => $this->input->post('coursename'),
			'course_description' => $this->input->post('coursediscription'),
			'course_fee' => $this->input->post('coursefee'),
			'state' => 'active',
			'staff_id' => $this->session->userdata('user_detail')['user_id'],
			'course_type' => $this->input->post('coursetype'),
			'submit_date' => Date('Y-m-d'),

		);
		// print_r($data_course);
		$result_registration = $this->course_model->add_new_course($data_course);
		if($result_registration == 1){
			$data['success_message_display'] = "Course registered successfully";
			$this->load->view('course-registration',$data);
			
		}else{
			$data['error_message_display'] = "Registration Fail";
			$this->load->view('course-registration',$data);
		}
	}

	}

	public function addNewBatch(){
		
		$this->form_validation->set_rules('batchnumber', 'Batch number', 'trim|required');
		$this->form_validation->set_rules('commencedate', 'Commence date', 'trim|required');
		$this->form_validation->set_rules('tentativeclosedate', 'Tentative closing date ', 'trim|required');
		$this->form_validation->set_rules('discription', 'Description ', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
			$this->load->view('batch-registration',$data);
		}else{



		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$data_course = array(
			'course_id' => $this->input->post('selectcourse'),
			'staff_id' => $this->session->userdata('user_detail')['user_id'],
			'batch_number' => $this->input->post('batchnumber'),
			'create_date' => Date('Y-m-d'),
			'commence_date' => $this->input->post('commencedate'),
			'tentitive_close_date' => $this->input->post('tentativeclosedate'),
			'close_date' => NULL,
			'discription' => $this->input->post('discription'),
			'state' => 'active',
			

		);
		// print_r($data_course);
		$result_registration = $this->course_model->map_batch_with_course($data_course);
		if($result_registration == 1){
			$data['success_message_display'] = "Batch created successfully";
			$this->load->view('batch-registration',$data);
			
		}else if($result_registration == 'batch found'){
			$data['error_message_display'] = "Batch number already in use";
			$this->load->view('batch-registration',$data);
		}else{
			$data['error_message_display'] = "Registration Fail";
			$this->load->view('batch-registration',$data);
		}

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
			$data['course_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			//print_r($data);
			$this->load->view('trainer-batch-map',$data);
		}else if($step == 3){
			// print_r($_POST);
			$data = array(
				'trainer_id' => $_POST['trainer_id'],
				'batch_id' => $_POST['select_batch'],
				'staff_id' => $this->session->userdata('user_detail')['user_id'],
				'added_date' => Date('Y-m-d'),
				'state' => 'active'

			);
			$result = $this->trainer_model->map_trainer_with_batch($data);
			if($result == 1){
				$this->session->set_flashdata('success_message_display','Trainer assigned to batch');
				redirect('/trainer/trainerBatch/1');
			}else if($result == 'user found'){
				$this->session->set_flashdata('error_message_display','Trainer already assigned to the batch');
				redirect('/trainer/trainerBatch/1');
			}else{
				$this->session->set_flashdata('error_message_display','Error came when assigning trainer to batch. Please try again');
				redirect('/trainer/trainerBatch/1');

			}
		}
		
	}


 public function courseProfile($courseid){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	if(isset($courseid)){

	 $course_details = $this->course_model->get_course_by_id($courseid);
	 $course_batches_object = $this->course_model->get_course_batch_details($courseid);

	//  print_r($trainer_details);
	//   print_r($course_batches_object);
	 if($course_batches_object != 0){
		$data['course_profile'] = $course_details;
		 $data['course_batches_object'] = $course_batches_object;
		//  print_r($data);
	 	 $this->load->view('course-profile',$data);
	 }else{
		$data['error_message_display'] = 'invalid input of trainer';
		// $this->load->view('course-search-view',$data);
	 }
	 
	}else{
		$data['errow_message_display'] = 'invalid input of trainer';
		// $this->load->view('course-search-view',$data);
	}
 }
 public function newSubject($step = 1,$editcourseid=0,$subjectid=0,$status=0){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	$flash_courseid = $this->session->flashdata('courseid');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	//  show existing active course
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('subject-registration',$data);
	}else if($step == 2 ){


		if(isset($flash_courseid) && !empty($flash_courseid)){
			$courseid = $flash_courseid;
		}elseif(isset($_POST['selectcourse'])){
			$courseid = $_POST['selectcourse'];
		}




		// if flash data or post data not available direct to step 1
		if(isset($courseid) && !empty($courseid)){
				// if no subject found retun 0
				$data['subjects'] = $this->course_model->get_all_subjects($courseid);
				$data['select_course_detail'] = $this->course_model->get_course_by_id($courseid);
	
				$this->load->view('subject-registration',$data);
			
		}elseif($editcourseid >0 && $subjectid > 0 && $status ==1){
			// show subject to edit
			$data['subjects'] = $this->course_model->get_all_subjects($editcourseid);
				$data['select_course_detail'] = $this->course_model->get_course_by_id($editcourseid);
			$data['select_course_detail'] = $this->course_model->get_course_by_id($editcourseid);
			$data['subject_detail'] = $this->course_model->get_subject($editcourseid,$subjectid);
			// print_r($data);
			$this->load->view('subject-registration',$data);
			
		}else{
				redirect('/course/newSubject/1');
		}
		
		
	}elseif ($step == 3) {
		// add new subject
		// print_r($_POST);
		
		$data = array(
			'course_id' => $_POST['courseid'],
			'subject_name' => $_POST['subject'],
			'state' => $_POST['state']
		);
		$result = $this->course_model->add_new_subject($data);
		if($result == 1){
			$this->session->set_flashdata('success_message_display','Subject added successfully');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');
		}else{
			$this->session->set_flashdata('error_message_display','Error came when inserting subject. Please try again');
				redirect('/trainer/newSubject/1');
		}
	}elseif($step == 4){
		// upddate selected subject
		// print_r($_POST);
		$data  = array(
			'course_id' => $_POST['courseid'],
			'subject_id' => $_POST['subjectid'],
			'subject_name' => $_POST['subject'],
			'state' => $_POST['state'],

		);

		$result_subject_update = $this->course_model->update_subject($data);

		if($result_subject_update == 1){
			$this->session->set_flashdata('success_message_display','Subject updated successfully');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');

		}else if($result_subject_update == 0){
			$this->session->set_flashdata('success_message_display','Nothing to update');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');

		}else{
			$this->session->set_flashdata('error_message_display','Error when updating subject. Please try again');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');
		}
	}


 }
 public function examCertificate($step=1,$courseid=0,$batchid=0,$studentid=0,$state=0){
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('exam-certificate-view',$data);
	}elseif ($step == 2) {
		// print_r($_POST);
		$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
		$data['select_course_detail'] = $select_course_detail;
		 
		$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
		$this->load->view('exam-certificate-view',$data);
	}elseif ($step == 3) {
		// print_r($_POST);
		$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
		$data['select_batch_detail'] = $this->user_model->read_batch_byid($_POST['selectbatch'])[0];
	
		$data['students_detail'] = $this->user_model->batch_wise_students($_POST['selectbatch']);
				 $this->load->view('exam-certificate-view',$data);
				  // print_r($data);
	}elseif($step == 4 && ($courseid > 0 && $batchid > 0 && $studentid>0 )){

		$data['select_course_detail'] = $this->course_model->get_course_by_id($courseid);
		$data['select_batch_detail'] = $this->user_model->read_batch_byid($batchid)[0];
		$data['select_student'] = $this->user_model->student_detail_byid($studentid);
		if($state == 'marks'){
			// show student marks form if exist to edit or add new 
		// 	$courseid,
		// $batchid,
		// $studentid,
		$data['students_detail'] = $this->user_model->batch_wise_students($batchid);
		$data['student_marks'] = $this->user_model->read_subject_and_marks_student_wise($studentid,$courseid,$batchid);
			
		// print_r($_POST);
		if(isset($_POST['subjectid']) && isset($_POST['newmark'])){
			// add subject marks
			$mark_data = array(
				'student_id' => $studentid,
				'batch_id' => $batchid,
				'mark' => $_POST['newmark'],
				'state' => $_POST['markstate'],
				'subject_id' => $_POST['subjectid'],
			);
		
			$result_subject_marks = $this->course_model->add_update_subject_mark($mark_data);
			// echo $result_subject_marks;
			if($result_subject_marks == 'insert'){
				$data['success_message_display'] = "Mark addded successfully";
			}else if($result_subject_marks == 'update'){
				$data['success_message_display'] = "Mark updated successfully";
			}else{
				$data['error_message_display'] = "Error on adding marks. Try again";
			}
			// $data['student_marks'] = $this->user_model->read_subject_and_marks_student_wise($studentid,$courseid,$batchid);
		}
		$data['student_marks'] = $this->user_model->read_subject_and_marks_student_wise($studentid,$courseid,$batchid);
		$data['student_id'] = $studentid;
		// print_r($data);
		 $this->load->view('exam-certificate-view',$data);


		}elseif($state == 'certificate'){
			// show student certificate form if exist to edit or add new 
			
			if(isset($_POST['certificatenumber']) && isset($_POST['studentid']) && isset($_POST['batchid'])){
				// add or update certificate details
				// echo "update certificate";
				$data_certificate = array(
					'student_id' => $_POST['studentid'],
					'batch_id' => $_POST['batchid'],
					'certificate_no' => $_POST['certificatenumber']
				);
				$result = $this->course_model->update_certificate($data_certificate);
				if($result == 'update'){
					$data['success_message_display'] = "certificate addded successfully";
				}else{
					$data['error_message_display'] = "Error on adding marks. Try again";
				}
			}
			$data['students_detail'] = $this->user_model->batch_wise_students($batchid);
			$data['student_batch_certificate'] =$this->user_model->read_student_detail_to_batch($studentid,$batchid);

			$this->load->view('exam-certificate-view',$data);

		}
		
	
	}
 }
 public function editbatch($batchid=0,$step=1){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	if($step==1){
		$batch_data = $this->user_model->read_batch_byid($batchid);
		if($batch_data){
		 $course_data = $this->user_model->read_course_byid($batch_data[0]->course_id);
		 $data['trainer_data'] = $this->user_model->trainer_map_to_batch($batchid);
 
		 $data['trainers'] = $this->user_model->read_trainers_detail();
 
		
		 $data['course_data'] = $course_data;
		 $data['batch_data'] = $batch_data;
		 $this->load->view('batch-edit-view',$data);
		}else{
 
		//  echo "error";
		 $data['error_message_display'] = "Error on adding marks. Try again";
		}
	}elseif($step == 2 && isset($_POST)){
		// print_r($_POST);
		$data=array(
			'course_id'=>$_POST['courseid'],
			'batch_id'=>$_POST['batchid'],
			'batch_number'=>$_POST['batchnumber'],
			'commence_date'=>$_POST['commencedate'],
			'tentitive_close_date'=>$_POST['tentetiveclosedate'],
			'close_date'=>$_POST['completedate'],
			'discription'=>$_POST['description'],
			'state'=>$_POST['batchstate'],
			'trainer_id'=>$_POST['trainer']
		);
		$result = $this->user_model->update_batch_byid($data);
		// need to update the trainer id aswell
		if($result == 1){
			$this->session->set_flashdata('success_message_display','Batch details update successfully');
			redirect('/course/editbatch/'.$data['batch_id']);
		}else if($result ==0){
			$this->session->set_flashdata('success_message_display','All upto date');
			redirect('/course/editbatch/'.$data['batch_id']);
		}else if($result == 'errortrainer'){
			$this->session->set_flashdata('error_message_display','error in adding trainer. Try again');
			redirect('/course/editbatch/'.$data['batch_id']);
		}
		else{
			$this->session->set_flashdata('error_message_display','Error occoured. Please try again');
			redirect('/course/editbatch/'.$data['batch_id']);
		}

	}
 }
 public function courseUpdate(){
	//  print_r($_POST);
	 $data = array(
		 'course_id' => $_POST['courseid'],
		 'course_name' => $_POST['coursetitle'],
		 'course_description' => $_POST['coursediscription'],
		 'course_fee' => $_POST['fee'],
		 'course_type' => $_POST['coursetype'],
		 'state' => $_POST['coursestate'],
		 
	 );
	 $result = $this->course_model->update_course($data);
	 if($result == 1){
		$this->session->set_flashdata('success_message_display','Course details update successfully');
		redirect('course/courseProfile/'.$data['course_id']);
	}else if($result ==0){
		$this->session->set_flashdata('success_message_display','All upto date');
		redirect('/course/courseProfile/'.$data['course_id']);
	}else{
		$this->session->set_flashdata('error_message_display','Error occoured. Please try again');
		redirect('/course/courseProfile/'.$data['course_id']);
	}
 }
 
 

}
?>
