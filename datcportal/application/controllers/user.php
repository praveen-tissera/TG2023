<?php
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('captcha');
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
		$this->load->model('attendance_model');
		// echo $this->router->fetch_method();
		if ($this->router->fetch_method() == 'verification') {
			$this->session->set_userdata('current_menu', 'verification');
		} else {

			$this->session->set_userdata('current_menu', 'dashboard');
		}
	}
	public function index()
	{
		if (isset($this->session->userdata['user_detail'])) {
			//if session is already set
			redirect('/user/staffDashBoard');
		} else {
			$this->load->view('login');
		}
	}


	public function userDetails()
	{
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->user_model->student_detail_byid($postData['username']);

		echo json_encode($data);
	}




	/*******************************************************cta Institute Code */

	public function login()
	{
		if (isset($this->session->userdata['user_detail'])) {
			//if session is already set
			// redirect('/user/studentTrainerDashBoard');
			// print_r($this->session->userdata('user_detail'));
			if ($this->session->userdata('user_detail')['type'] == 'admin' || $this->session->userdata('user_detail')['type'] == 'coordinator') {
				$this->load->view('staff-login');
			} else if ($this->session->userdata('user_detail')['type'] == 'trainer' || $this->session->userdata('user_detail')['type'] == 'student') {
				$this->load->view('login');
			}
		} else {
			$this->load->view('login');
		}
	}

	public function userLogin()
	{
		if (isset($this->session->userdata['user_detail'])) {
			//if session is already set
			redirect('/user/studentTrainerDashBoard');
		} else {
			$data['usernames'] = $this->user_model->all_students();

			$this->load->view('login', $data);
		}
	}

	public function staffLogin()
	{
		if (isset($this->session->userdata['user_detail'])) {
			//if session is already set
			redirect('/user/staffDashBoard');
		} else {
			$this->load->view('staff-login');
		}
	}



	/**
	 * 
	 * cta student and trainer login
	 * 
	 * 
	 */
	public function studentTrainerLogin()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['user_detail'])) {
				//if session is already set
				redirect('/user/clientDashBoard');
			} else {
				$data['user_type'] = 'client';
				$this->load->view('login', $data);
			}
		} else {
			$data = array(
				'email' => $this->input->post('email'),
				'password' => sha1($this->input->post('password')),
				'user-type' => $this->input->post('user-type'),
			);

			$result = $this->user_model->student_trainer_login($data);
			if ($result == TRUE) {
				echo "success";
				$result = $this->user_model->read_StudentTraner_information($data['email'], $data['user-type']);

				if ($data['user-type'] == 'student') {
					$user_menu = [
						'profile' => 'My Profile',

						'myCourse' => 'My Courses',
						'myAttendance' => 'Attendance'
					];
					$user_session_data = array(
						'user_id' => $result[0]->student_id,
						'fname' => $result[0]->frist_name,
						'lname' => $result[0]->last_name,
						'email' => $result[0]->email,
						'birth-date' => $result[0]->birth_date,
						'staff-id' => $result[0]->staff_id,
						'register-date' => $result[0]->register_date,
						'state' => $result[0]->state,
						'login' => TRUE,
						'type' => 'student',
						'user-wise-menu' => $user_menu
					);
				} else {
					$user_menu = [
						'profile' => 'My Profile',

						'attendance' => 'Attendance',

						'trainerCourse' => 'My Courses',

					];
					$user_session_data = array(
						'user_id' => $result[0]->trainer_id,
						'fname' => $result[0]->first_name,
						'lname' => $result[0]->last_name,
						'email' => $result[0]->email,
						'register-date' => $result[0]->register_date,
						'register-date' => $result[0]->register_date,
						'state' => $result[0]->state,
						'login' => TRUE,
						'type' => 'trainer',
						'user-wise-menu' => $user_menu
					);

					// print_r($user_session_data);
				}

				$this->session->set_userdata('user_detail', $user_session_data);
				redirect('/user/clientDashBoard');
			} else {
				$data = array(
					'error_message_display' => 'Invalid Username or Password'
				);
				$this->load->view('login', $data);
			}
		}
	}

	/**
	 * 
	 * cta staff login
	 * 
	 * 
	 */
	public function staffMemberLogin()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['user_detail'])) {
				//if session is already set
				redirect('/user/staffDashBoard');
			} else {

				$this->load->view('staff-login');
			}
		} else {
			$data = array(
				'email' => $this->input->post('email'),
				'password' => sha1($this->input->post('password')),
			);
			print_r($data);
			$result = $this->user_model->staff_login($data);
			if ($result == TRUE) {

				echo "success";
				$result = $this->user_model->read_Staff_information($data['email']);
				if ($result[0]->role_type == 'admin') {
					$user_menu = [
						'profile' => 'My Profile',
						'staff' => 'Staff Management',
						'student' => 'Student Management',
						'trainer' => 'Trainer Management',
						'course' => 'Course Management',
						'report' => 'Reports',
						'attendance' => 'Attendance'
					];
				} else if ($result[0]->role_type == 'coordinator') {
					$user_menu = [
						'profile' => 'My Profile',
						'staff' => 'Staff Management',
						'student' => 'Student Management',
						'trainer' => 'Trainer Management',
						'course' => 'Course Management',
						'report' => 'Reports',
						'attendance' => 'Attendance'
					];
				}


				$user_session_data = array(
					'user_id' => $result[0]->staff_id,
					'staff-name' => $result[0]->staff_name,
					'email' => $result[0]->email,
					'state' => $result[0]->state,
					'login' => TRUE,
					'type' => $result[0]->role_type,
					'user-wise-menu' => $user_menu
				);

				// print_r($user_session_data);

				$this->session->set_userdata('user_detail', $user_session_data);
				redirect('/user/staffDashBoard');
			} else {
				$data = array(
					'error_message_display' => 'Invalid Username or Password'
				);
				$this->load->view('staff-login', $data);
			}
		}
	}


	/**
	 * Show staff dashboard page
	 */
	public function staffDashBoard()
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}

		// $client_detail = $this->session->userdata('user_detail');

		// $result = $this->user_model->show_client_booking($client_detail['user_id']);

		$this->load->view('staff-dashboard');
	}

	/**
	 * Show student and trainer  dashboard page
	 */
	public function clientDashBoard()
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}

		$client_detail = $this->session->userdata('user_detail');
		// print_r($client_detail);
		// $result = $this->user_model->show_client_booking($client_detail['user_id']);

		$this->load->view('client-dashboard');
	}

	public function showCourse($category)
	{
		if ($category == 'diploma') {
			$result_course = $this->user_model->read_active_course($category);
			//print_r($result_course);
			if (!$result_course) {
				// echo "cannot find diploma related courses";
				$data['error_message_display'] = 'cannot find diploma related courses';
			} else {
				foreach ($result_course as $key => $single_course) {
					$result_batch = $this->user_model->read_active_batch($single_course->course_id);
					//print_r($single_course->course_name);
					$single_course->datch_detail = $result_batch;
					$result_course_with_batch[] = $single_course;
				}
			}

			$data['course_wise_active_batch'] = $result_course_with_batch;
			$data['category'] = $category;
			$this->load->view('course-diploma', $data);
		} else if ($category == 'training') {
			$result_course = $this->user_model->read_active_course($category);
			if (!$result_course) {
				echo "cannot find traning related courses";
				$data['error_message_display'] = 'cannot find training related courses';
			} else {
				foreach ($result_course as $key => $single_course) {
					$result_batch = $this->user_model->read_active_batch($single_course->course_id);
					//print_r($single_course->course_name);
					$single_course->datch_detail = $result_batch;
					$result_course_with_batch[] = $single_course;
				}

				$data['course_wise_active_batch'] = $result_course_with_batch;
				$data['category'] = $category;
			}


			$this->load->view('course-diploma', $data);
		}
	}

	public function veiwRegister($coursId, $batchId)
	{

		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}



		$result_course = $this->user_model->read_active_course_byid($coursId);
		$result_batch = $this->user_model->read_active_batch_byid($batchId);
		$data['student_register_to_course'] = 0;
		if (isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student') {

			$result_student_course_select = $this->user_model->read_student_register_to_course($this->session->userdata['user_detail']['user_id'], $batchId);
			if ($result_student_course_select) {
				// echo "student already register";
				$data['student_register_to_course'] = 1;
			} else {
				$data['student_register_to_course'] = 0;
			}
		}



		// print_r($result_course);
		// print_r($result_batch);
		$data['course_detail'] = $result_course;
		$data['batch_detail'] = $result_batch;
		$this->load->view('register', $data);
	}

	/**
	 * student register online after register coordinator should approve
	 */
	public function studentRegisterOnline($course_id, $batch_id)
	{

		if (isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student') {

			$student_log = true;
			$student_id = $this->session->userdata['user_detail']['user_id'];
			$data = null;

			$result = $this->user_model->student_registration_online($data, $batch_id, $student_log, $student_id);
			if ($result == 0) {

				$this->session->set_flashdata('error_message_display', 'A user exist with the email address, please login to proceed');
				// redirect('user/veiwRegister/'.$course_id.'/'.$batch_id);

			} else {
				// echo "<hr>";
				// echo $result;
				if (isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student') {
					$this->session->set_flashdata('success_message_display', 'Detail submitted sucessfully');
					redirect('/user/clientDashBoard');
				} else {
					$data['success_message_display'] = 'Registered successfully';
					$this->load->view('login', $data);
				}
			}
		} else {
			$student_log = false;
			$student_id = 0;
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('telephone', 'Contact', 'trim|required');
			if ($this->form_validation->run() == FALSE) {

				// $this->session->set_flashdata('error_message_display','Error processing the form. ');
				// redirect('user/veiwRegister/'.$course_id.'/'.$batch_id);
				//$this->load->view('register',$data);


				$result_course = $this->user_model->read_active_course_byid($course_id);
				$result_batch = $this->user_model->read_active_batch_byid($batch_id);
				$data['course_detail'] = $result_course;
				$data['batch_detail'] = $result_batch;
				$this->load->view('register', $data);
			} else {
				$data = array(
					'first_name' => $this->input->post('firstname'),
					'last_name' => $this->input->post('lastname'),
					'birth_date' => $this->input->post('bdate'),
					'email' => $this->input->post('email'),
					'telephone' => $this->input->post('telephone'),
					'password' => sha1($this->input->post('password')),
					'staff_id' => 3,
					'state' => 'pending',
					'register_date' => Date('Y-m-d'),

				);

				$result = $this->user_model->student_registration_online($data, $batch_id, $student_log, $student_id);
				if (!$result) {

					$this->session->set_flashdata('error_message_display', 'A user exist with the email address, please login to proceed');
					redirect('user/veiwRegister/' . $course_id . '/' . $batch_id);
				} else {
					// echo "<hr>";
					// echo $result;
					if (isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student') {
						$this->session->set_flashdata('success_message_display', 'Detail submitted sucessfully');
						redirect('/user/studentTrainerDashboard');
					} else {
						$data['success_message_display'] = 'Registered successfully';
						$this->load->view('login', $data);
					}
				}
			}
		}






		//print_r($_POST);

	}

	/**
	 * student management dashboard
	 */

	public function student()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['studentManagement'] = array(
				'newRegistration' => 'New Registration',
				'pendingOnlineRegistration' => 'Pending online Registration',
				'searchStudent' => 'Registered Students',
			);

			$this->load->view('student-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['studentManagement'] = array(
				'newRegistration' => 'New Registration',
				'pendingOnlineRegistration' => 'Pending online Registration',
				'searchStudent' => 'Registered Students',
			);

			$this->load->view('student-management', $data);
		}
	}


	/**
	 *  current login user profile 
	 */

	public function profile()
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}

		if ($this->session->userdata('user_detail')['type'] == 'admin' || $this->session->userdata('user_detail')['type'] == 'coordinator') {

			$data['profile'] = $this->user_model->get_Staff_detail_by_id($this->session->userdata('user_detail')['user_id'])[0];
			$data['profile']->user_role = $this->session->userdata('user_detail')['type'];
		} else if ($this->session->userdata('user_detail')['type'] == 'trainer') {
			$data['profile'] = $this->user_model->read_trainer_detail($this->session->userdata('user_detail')['user_id']);
			$data['profile']->user_role = $this->session->userdata('user_detail')['type'];
		} else if ($this->session->userdata('user_detail')['type'] == 'student') {

			$data['profile'] = $this->user_model->student_detail_byid($this->session->userdata('user_detail')['user_id'])[0];

			$data['profile']->user_role = $this->session->userdata('user_detail')['type'];
		}



		$this->load->view('my-profile', $data);
	}
	/**
	 * update user profil
	 */
	public function profileUpdate($section, $role)
	{
		if ($role == 'admin' || $role == 'coordinator') {

			if ($section == 'profile') {
				$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);

				if ($result_update_profile == 1) {
					$this->session->set_flashdata('success_message_display', 'profile update successfully');
					redirect('/user/profile');
				} else if ($result_update_profile == 0) {
					$this->session->set_flashdata('success_message_display', 'No data found to update');
					redirect('/user/profile');
				} else {
					$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
					redirect('/user/profile');
				}
			} else if ($section == 'password') {

				$staff_detail = $this->user_model->get_Staff_detail_by_id($this->session->userdata('user_detail')['user_id'])[0];

				$_POST['currentpsw'] = sha1($_POST['currentpsw']);
				$_POST['newpsw'] = sha1($_POST['newpsw']);
				$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
				$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
				if ($_POST['currentpsw'] === $staff_detail->password) {
					if ($_POST['newpsw'] === $staff_detail->password) {
						$this->session->set_flashdata('error_message_display', 'New password cannot be same as old password');
						redirect('/user/profile');
					} elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
						print_r($_POST);
						$this->session->set_flashdata('error_message_display', 'New password and confirm password mismatch');
						redirect('/user/profile');
					} else {
						echo "update password and logout";
						$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);


						if ($result_update_profile == 1) {
							$this->logoutUser($role, 'updatepsw');
						} else if ($result_update_profile == 0) {
							$this->session->set_flashdata('success_message_display', 'No data found to update');
							redirect('/user/profile');
						} else {
							$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
							redirect('/user/profile');
						}
					}
				} else {
					$this->session->set_flashdata('error_message_display', 'Password missmatch');
					// redirect('/user/profile');
				}
			}
		} else if ($role == 'trainer') {
			print_r($_POST);
			if ($section == 'profile') {
				$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);

				if ($result_update_profile == 1) {
					$this->session->set_flashdata('success_message_display', 'profile update successfully');
					redirect('/user/profile');
				} else if ($result_update_profile == 0) {
					$this->session->set_flashdata('success_message_display', 'No data found to update');
					redirect('/user/profile');
				} else {
					$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
					redirect('/user/profile');
				}
			} else if ($section == 'password') {
				$trainer_detail = $this->user_model->read_trainer_detail($this->session->userdata('user_detail')['user_id']);
				$_POST['currentpsw'] = sha1($_POST['currentpsw']);
				$_POST['newpsw'] = sha1($_POST['newpsw']);
				$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
				$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
				if ($_POST['currentpsw'] === $trainer_detail->password) {
					if ($_POST['newpsw'] === $trainer_detail->password) {
						$this->session->set_flashdata('error_message_display', 'New password cannot be same as old password');
						redirect('/user/profile');
					} elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
						print_r($_POST);
						$this->session->set_flashdata('error_message_display', 'New password and confirm password mismatch');
						redirect('/user/profile');
					} else {
						echo "update password and logout";
						$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);


						if ($result_update_profile == 1) {
							$this->logoutUser($role, 'updatepsw');
						} else if ($result_update_profile == 0) {
							$this->session->set_flashdata('success_message_display', 'No data found to update');
							redirect('/user/profile');
						} else {
							$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
							redirect('/user/profile');
						}
					}
				} else {
					$this->session->set_flashdata('error_message_display', 'Password missmatch');
					redirect('/user/profile');
				}
			}
		} else if ($role == 'student') {
			print_r($_POST);
			if ($section == 'profile') {

				$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);

				if ($result_update_profile == 1) {
					$this->session->set_flashdata('success_message_display', 'profile update successfully');
					redirect('/user/profile');
				} else if ($result_update_profile == 0) {
					$this->session->set_flashdata('success_message_display', 'No data found to update');
					redirect('/user/profile');
				} else {
					$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
					redirect('/user/profile');
				}
			} else if ($section == 'password') {
				print_r($_POST);
				$staff_detail = $this->user_model->student_detail_byid($this->session->userdata('user_detail')['user_id'])[0];

				$_POST['currentpsw'] = sha1($_POST['currentpsw']);
				$_POST['newpsw'] = sha1($_POST['newpsw']);
				$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
				$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
				if ($_POST['currentpsw'] === $staff_detail->password) {
					if ($_POST['newpsw'] === $staff_detail->password) {
						$this->session->set_flashdata('error_message_display', 'New password cannot be same as old password');
						redirect('/user/profile');
					} elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
						print_r($_POST);
						$this->session->set_flashdata('error_message_display', 'New password and confirm password mismatch');
						redirect('/user/profile');
					} else {
						echo "update password and logout";
						$result_update_profile = $this->user_model->update_profile($section, $role, $_POST);


						if ($result_update_profile == 1) {
							$this->logoutUser($role, 'updatepsw');
						} else if ($result_update_profile == 0) {
							$this->session->set_flashdata('success_message_display', 'No data found to update');
							redirect('/user/profile');
						} else {
							$this->session->set_flashdata('error_message_display', 'Error processing the form. ');
							redirect('/user/profile');
						}
					}
				} else {
					$this->session->set_flashdata('error_message_display', 'Password missmatch');
					redirect('/user/profile');
				}
			}
		}
	}

	/**
	 * staff management dashboard
	 */

	public function staff()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['staffManagement'] = array(
				'newStaffRegistration' => 'New Staff Member',
				'searchStaff' => 'Search Staff Member',
			);

			$this->load->view('staff-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['staffManagement'] = array(

				'searchStaff' => 'Search Staff Member'
			);

			$this->load->view('staff-management', $data);
		}
	}


	/**
	 * trainer management dashboard
	 */

	public function trainer()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['trainerManagement'] = array(
				'newTrainerRegistration' => 'New Trainer',
				'trainerBatch' => 'Assign Trainer to Batch',
				'searchTrainer' => 'Search Trainer',
			);

			$this->load->view('trainer-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['trainerManagement'] = array(

				'trainerBatch' => 'Assign Trainer to Batch',
				'searchTrainer' => 'Search Trainer',
			);

			$this->load->view('trainer-management', $data);
		}
	}

	/**
	 * attendance management dashboard
	 */

	public function attendance()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['studentManagement'] = array(
				'newAttendanceRegistration' => 'Add Attendance',
				'searchAttendance' => 'Search Attendance',
			);

			$this->load->view('attendance-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['studentManagement'] = array(
				'newAttendanceRegistration' => 'Add Attendance',
				'searchAttendance' => 'Search Attendance',
			);

			$this->load->view('attendance-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'trainer') {
			$data['studentManagement'] = array(
				'newAttendanceRegistration' => 'Add Attendance',
				'searchAttendance' => 'Search Attendance',
			);

			$this->load->view('attendance-management', $data);
		}
	}

	/**
	 * report management dashboard
	 */

	public function report()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['studentManagement'] = array(
				'incomeReport' => 'Income Report',
				'registrationReport' => 'Registration Report',
				'dueReport' => 'Over Due Report',
			);

			$this->load->view('report-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['studentManagement'] = array(
				'incomeReport' => 'Income Report',
				'registrationReport' => 'Registration Report',
				'dueReport' => 'Over Due Report',
			);

			$this->load->view('report-management', $data);
		}
	}


	/**
	 * course batch management dashboard
	 */
	public function course()
	{
		// $session = $this->session->userdata['user_detail'];

		if ($this->session->userdata['user_detail']['type'] == 'admin') {
			$data['studentManagement'] = array(
				'newCourseRegistration' => 'New Course',
				'newBatchRegistration' => 'New Batch',
				'searchCourse' => 'Search Course & Batch',
				'newSubject' => 'New Subject',
				'examCertificate' => 'Batch wise students <br>(Exam & Certificate)'
			);

			$this->load->view('course-management', $data);
		} else if ($this->session->userdata['user_detail']['type'] == 'coordinator') {
			$data['studentManagement'] = array(

				'newBatchRegistration' => 'New Batch',
				'searchCourse' => 'Search Course & Batch',

				'examCertificate' => 'Batch wise students<br>(Exam & Certificate)'
			);

			$this->load->view('course-management', $data);
		}
	}

	public function pendingOnlineRegistration()
	{
		$result = $this->user_model->get_pending_students();
		if ($result != 0) {
			foreach ($result as $key => $student) {
				//print_r($student);
				$result_batch = $this->user_model->get_pending_student_batch($student->student_id);
				//  print_r($result_batch);
				foreach ($result_batch as $key => $batch) {
					$result_batch_indetail = $this->user_model->read_active_batch_byid($batch->batch_id);
					//print_r($result_batch_indetail[0]);
					$batch->batch_number = $result_batch_indetail[0]->batch_number;
					$result_course_indetail = $this->user_model->read_active_course_byid($result_batch_indetail[0]->course_id);
					//print_r($result_course_indetail[0]);
					$batch->course_name = $result_course_indetail[0]->course_name;
					$batch->course_id = $result_course_indetail[0]->course_id;
					$batch_detail_final[] = $batch;
					//print_r($result_batch[$key]->batch_id);
				}
				//print_r($batch_detail_final);
				$student->batch_summary = $batch_detail_final;
				unset($batch_detail_final);
				//print_r($batch_detail_final); 
				// $student->batch_detail = $result_batch;
				$pending_student_detail[] = $student;
				$data['peding_student_registration'] = $pending_student_detail;
			}
			$this->load->view('pending-student-registration', $data);
		} else {
			$data['success_message_display'] = 'Pending registration details not found';
			$this->load->view('pending-student-registration', $data);
		}

		// print_r($pending_student_detail);

	}

	public function registerStudent($student_state, $student_id, $course_id, $batch_id)
	{
		//check student status and proceed 
		if ($student_state == 'pending') {
			//new registration to the batch
			$result_student_detail = $this->user_model->student_detail_byid($student_id);
			//print_r($result_student_detail);
			$result_course_detail = $this->user_model->read_course_byid($course_id);
			//print_r($result_course_detail);
			$result_batch_detail = $this->user_model->read_batch_byid($batch_id);
			//print_r($result_batch_detail);

			$data = array(
				'student_detail' => $result_student_detail,
				'course_detail' => $result_course_detail,
				'batch_detail' => $result_batch_detail
			);
			$this->load->view('pending-registration-form', $data);
		}
	}

	/**
	 * confirm student first payment those who do online registration
	 */


	public function studentRegisterconfirm()
	{
		//  print_r($_POST);
		if ($_POST['pay_type'] == 1) {


			$result_update_student = $this->user_model->update_student_payment($_POST, $this->session->userdata('user_detail')['user_id']);
			echo "receipt number <br>";
			echo $result_update_student;
			// check whether receipt get from model
			if ($result_update_student !== 0) {
				// $data['success_message_display'] = 'Student detail updated successfully.';
				// $data['receipt_number'] = $result_update_student;
				$_POST['recreipt_number'] = $result_update_student;
				$data['student_details'] = $_POST;
				print_r($data);
				// $this->load->view('student-first-payment-confirmation',$data);
				$this->session->set_flashdata('success_message_display', 'Student detail updated successfully.');
				$this->session->set_flashdata('student_details', $data);
				redirect('/user/newRegistration/1/1');
			}
		} else if ($_POST['pay_type'] == 2) {

			$result_update_student = $this->user_model->update_student_payment($_POST, $this->session->userdata('user_detail')['user_id']);
			// part payment only first installment
			// print_r($_POST);
			// check whether receipt get from model
			if ($result_update_student !== 0) {
				// $data['success_message_display'] = 'Student detail updated successfully';
				$_POST['recreipt_number'] = $result_update_student;
				$data['student_details'] = $_POST;
				print_r($data);


				$this->session->set_flashdata('success_message_display', 'Student detail updated successfully');
				$this->session->set_flashdata('student_details', $data);
				redirect('/user/newRegistration/1/1');
				// $this->load->view('student-first-payment-confirmation',$data);
			}
		}
	}

	public function newRegistration($step = '1', $online = 0)
	{

		/**
		 * step one -  select course
		 * step two - select batch and payment type
		 * step three - student details
		 */
		if ($step == '1') {

			$success = $this->session->flashdata('success_message_display');
			$student_details = $this->session->flashdata('student_details');
			$error = $this->session->flashdata('error_message_display');
			if (!empty($success) && !empty($student_details)) {
				$data['success_message_display'] = $success;
				$data['student_details'] = $student_details;
				$data['online'] = $online;
			} else if (!empty($success)) {
				$data['success_message_display'] = $success;
			}
			if (!empty($error)) {
				$data['error_message_display'] = $error;
			}


			// get all courses into drop down
			$data['all_courses'] = $this->user_model->read_all_active_courses();
			// print_r($data);
			$this->load->view('new-student-offline-registration', $data);
		}
		if ($step == '2') {
			// /print_r($_POST);
			$data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course']);
			// print_r($course_details[0]);
			$data['all_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			//  print_r($data);
			$this->load->view('new-student-offline-registration', $data);
		}
		if ($step == '3') {
			if(isset($_POST['class-fee'])){
				$institute_fee =	$this->input->post('class-fee');
			}else{
				$institute_fee  = 0;
			}
			// submission
			// print_r($_POST);
			// Array ( [course-id] => 1 [selected_batch] => 2 [payment_mode] => full [due-date] => 2022-02-08 [firstname] => roshi [lastname] => fernando [bdate] => 2007-06-05 [email] => roshi@gmail.com [telephone] => 1234567 [password] => 71160457V )
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('telephone', 'Contact', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');



			if ($this->form_validation->run() == FALSE) {
				$data['select_course'] = $this->user_model->read_active_course_byid($_POST['course-id']);

				$data['all_batches'] = $this->user_model->read_active_batch($_POST['course-id']);

				$this->load->view('new-student-offline-registration', $data);
			} else {
				$data_student = array(
					'first_name' => $this->input->post('firstname'),
					'last_name' => $this->input->post('lastname'),
					'birth_date' => $this->input->post('bdate'),
					'email' => $this->input->post('email'),
					'telephone' => $this->input->post('telephone'),
					'password' => sha1($this->input->post('password')),
					'staff_id' => $this->session->userdata('user_detail')['user_id'],
					'state' => 'active',
					'register_date' => Date('Y-m-d'),

				);
				$data_course_batch = array(
					'batch_id' => $this->input->post('completed'),
					'staff_id' => $this->session->userdata('user_detail')['user_id'],
					'added_date' => Date('Y-m-d'),
					'state' => 'active',
					'certificate_no' => NuLL
				);
				$pay_type = ($this->input->post('payment_mode') == 'full') ? '1' : '2';
				$payment_detail = array(
					'payment_mode' => $this->input->post('payment_mode'),
					'pay_type' => $pay_type,
					'fullpayment' => $this->input->post('fullpayment'),
					'installmentone' => $this->input->post('installmentone'),
					'installmenttwo' => $this->input->post('installmenttwo'),
					'due-date' => $this->input->post('due-date'),
					'month'=>$this->input->post('selected-month')
				);
				print_r($data_course_batch);
				$registration_details = $this->user_model->register_student_offiline($data_student, $data_course_batch, $payment_detail,$institute_fee);

				if ($registration_details == 'email found') {
					$data['error_message_display'] = "Student Registration fail. User with the same email exist!";
					$this->load->view('student-first-payment-confirmation', $data);
				} else {
					$student_batch_payment = array_merge($data_student, $data_course_batch, $payment_detail, $registration_details);
					// print_r($student_batch_payment);
					// $data['success_message_display'] = "Student registered successfully";
					$data['student_detail'] = $student_batch_payment;

					$this->session->set_flashdata('success_message_display', 'Student registered successfully');
					$this->session->set_flashdata('student_details', $data);
					redirect('/user/newRegistration/1');
				}
			}
		}
	}


	/**
	 * fee management
	 */

	public function feeManage($studentId, $courseId=0, $step = 0)
	{$success = $this->session->flashdata('success_message_display');
		// $student_details = $this->session->flashdata('student_details');
		$error = $this->session->flashdata('error_message_display');
		 if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}


		$courses = array();
			$course_detail = array();
			$data['history'] = $this->user_model->student_wise_batches_course($studentId);
			$data['history_institutefee'] = $this->user_model->student_institution_payment_history($studentId);
			
		if($step == 0){
			
			
			foreach ($data['history'] as $key => $batch) {
				// print_r($batch->batch_object);
				if(!in_array($batch->batch_object->course_id, $courses)){
					// print_r($batch->batch_object );
					array_push($courses,	$batch->batch_object->course_id );
					array_push($course_detail,	$batch);
					// array_push($course_detail,	$batch );
	
				}
	
	
	
			 }
			 $data['courses'] = $course_detail;
			// $this->load->view('payfee-view', $data);
			print_r($data);
		}
	
	

		if ($step == 1) {
			$data['select_course'] = $this->user_model->read_active_course_byid($courseId);
			// print_r($course_details[0]);
			$data['all_batches'] = $this->user_model->read_active_batch($courseId);
			// echo '<pre>';
			//   print_r($data);
			// echo '</pre>';
			$data['studentId'] = $studentId;
			$data['courseId'] = $courseId;

			// print_r($data);
			foreach ($data['history'] as $key => $batch) {
				// print_r($batch->batch_object);
				if(!in_array($batch->batch_object->course_id, $courses)){
					// print_r($batch->batch_object );
					array_push($courses,	$batch->batch_object->course_id );
					array_push($course_detail,	$batch);
					// array_push($course_detail,	$batch );
	
				}
	
	
	
			 }
			 $data['courses'] = $course_detail;
			//  $this->load->view('payfee-view', $data);
		}
		if($step == 2){
				// print_r($_POST);

				if(isset($_POST['class-fee'])){
					$institute_fee =	$this->input->post('class-fee');
				}else{
					$institute_fee  = 0;
				}
				$payment_detail = array(
					'staff_id' => $this->session->userdata('user_detail')['user_id'],
					'payment_mode' =>'full',
					'pay_type' => 1,
					'fullpayment' => $this->input->post('course-fee'),
					'installmentone' => null,
					'installmenttwo' => null,
					'due-date' => null,
					'month'=>$this->input->post('selected-month')
				);
				// print_r($institute_fee);

				$batch_ids = $this->input->post('completed');
				$this->user_model-> add_fees($studentId,$batch_ids,$payment_detail, $institute_fee);

				$this->session->set_flashdata('success_message_display', 'Payment added successfully');
			
				redirect('/user/feeManage/'.$studentId.'/'.$courseId.'/1');
		}
		$this->load->view('payfee-view', $data);
		

		
		// print_r($course_detail);
		/**
		 * step one -  select course
		 * step two - select batch and payment type
		 * step three - student details
		 */
		//    if($step == '1'){

		// 	   $success = $this->session->flashdata('success_message_display');
		// 	   $student_details = $this->session->flashdata('student_details');
		// 	   $error = $this->session->flashdata('error_message_display');
		// 	   if(!empty($success) && !empty($student_details)){
		// 		   $data['success_message_display'] = $success;
		// 		   $data['student_details'] = $student_details;
		// 		   $data['online'] = $online;

		// 	   }else if(!empty($success)){
		// 		   $data['success_message_display'] = $success;

		// 	   }
		// 	   if(!empty($error)){
		// 		   $data['error_message_display'] = $error;

		// 	   }


		// 	   // get all courses into drop down
		// 	   $data['all_courses'] = $this->user_model->read_all_active_courses();
		// 	   // print_r($data);
		// 		$this->load->view('new-student-offline-registration',$data);

		//    }
		//    if($step == '2'){
		// 	   // /print_r($_POST);
		// 	   $data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course']);
		// 	   // print_r($course_details[0]);
		// 		$data['all_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
		// 	   //  print_r($data);
		// 		$this->load->view('new-student-offline-registration',$data);

		//    }
		//    if($step == '3'){
		// 	   // submission
		// 	   // print_r($_POST);
		// 	   // Array ( [course-id] => 1 [selected_batch] => 2 [payment_mode] => full [due-date] => 2022-02-08 [firstname] => roshi [lastname] => fernando [bdate] => 2007-06-05 [email] => roshi@gmail.com [telephone] => 1234567 [password] => 71160457V )
		// 	   $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
		// 	   $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
		// 	   $this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');

		// 	   $this->form_validation->set_rules('email', 'Email', 'trim|required');
		// 	   $this->form_validation->set_rules('telephone', 'Contact', 'trim|required');
		// 	   $this->form_validation->set_rules('password', 'Password', 'trim|required');




		// 	   if ($this->form_validation->run() == FALSE) {
		// 	   $data['select_course'] = $this->user_model->read_active_course_byid($_POST['course-id']);

		// 		$data['all_batches'] = $this->user_model->read_active_batch($_POST['course-id']);

		// 		$this->load->view('new-student-offline-registration',$data);

		//    }else{
		// 	   $data_student = array(
		// 		   'first_name' => $this->input->post('firstname'),
		// 		   'last_name' => $this->input->post('lastname'),
		// 		   'birth_date' => $this->input->post('bdate'),
		// 		   'email' => $this->input->post('email'),
		// 		   'telephone' => $this->input->post('telephone'),
		// 		   'password' => sha1($this->input->post('password')),
		// 		   'staff_id' => $this->session->userdata('user_detail')['user_id'],
		// 		   'state' => 'active',
		// 		   'register_date' => Date('Y-m-d'),

		// 	   );
		// 	   $data_course_batch = array(
		// 		   'batch_id'=> $this->input->post('completed'),
		// 		   'staff_id'=> $this->session->userdata('user_detail')['user_id'],
		// 		   'added_date'=> Date('Y-m-d'),
		// 		   'state'=> 'active',
		// 		   'certificate_no' => NuLL
		// 	   );
		// 	   $pay_type = ($this->input->post('payment_mode') == 'full') ? '1':'2';
		// 	   $payment_detail = array(
		// 		   'payment_mode' => $this->input->post('payment_mode'),
		// 		   'pay_type' => $pay_type,
		// 		   'fullpayment'=> $this->input->post('fullpayment'),
		// 		   'installmentone' => $this->input->post('installmentone'),
		// 		   'installmenttwo' => $this->input->post('installmenttwo'),
		// 		   'due-date' =>$this->input->post('due-date')
		// 	   );
		// 	   print_r($data_course_batch);
		// 		$registration_details = $this->user_model->register_student_offiline($data_student,$data_course_batch,$payment_detail);

		// 		if($registration_details == 'email found'){
		// 		   $data['error_message_display'] = "Student Registration fail. User with the same email exist!";
		// 		   $this->load->view('student-first-payment-confirmation', $data);
		// 		}else{
		// 			 $student_batch_payment = array_merge($data_student,$data_course_batch,$payment_detail,$registration_details);
		// 			   // print_r($student_batch_payment);
		// 			   // $data['success_message_display'] = "Student registered successfully";
		// 			   $data['student_detail'] = $student_batch_payment;

		// 			   $this->session->set_flashdata('success_message_display','Student registered successfully');
		// 			   $this->session->set_flashdata('student_details',$data);
		// 			   redirect('/user/newRegistration/1');

		// 		}
		//    }



		//    }

	}





	/**
	 * search students base on the text send
	 */
	public function searchStudent()
	{
		// show default student search page
		if (isset($_POST['search-text']) && isset($_POST['type'])) {
			// print_r($_POST);
			$student_search_result = $this->search_model->search_student($_POST);
			// print_r($student_search_result);
			// if found students
			if ($student_search_result == 0) {
				$data = array(
					'error_message_display'  => 'No result found',
					'search_input' => $_POST
				);
				$this->load->view('student-search-view', $data);
			} else {
				$data = array(
					'success_message_display' => 'Found result',
					'search_result' => $student_search_result,
					'search_input' => $_POST
				);
				$this->load->view('student-search-view', $data);
			}
		} else {
			$this->load->view('student-search-view');
		}
	}

	/**
	 * view indiviual student details
	 * course selected
	 * payment details
	 */
	public function studentProfile($studentid)
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}
		if (isset($studentid)) {
			// $student_profile = $this->user_model->student_detail_byid($studentid);
			$student_courses_batches = $this->user_model->student_wise_batches_course($studentid);
			//$student_courses_batches = $this->user_model->batch_details_with_course_detail(1);
			// $student_courses_batches = $this->user_model->payment_schedule(17,2);
			// print_r($student_courses_batches);a
			$data['student_profile'] = $this->user_model->student_detail_byid($studentid)[0];
			$data['student_object'] = $student_courses_batches;
			$this->load->view('student-profile', $data);
		} else {
			echo "invalid input";
		}
	}

	/**
	 * update installments which are settle after 1st installment
	 */
	public function payInstallment($paymentid, $batchid, $studentid)
	{

		$payment_schedule_detials = $this->user_model->payment_schedule_by_paymentid($paymentid);

		echo $this->session->userdata('user_detail')['user_id'];
		$result_add_installment  = $this->user_model->add_installment_payment($paymentid, $batchid, $this->session->userdata('user_detail')['user_id'], $payment_schedule_detials[0]->amount, $studentid);

		if ($result_add_installment == 1) {
			//  echo "true";
			$this->session->set_flashdata('success_message_display', 'installment payment added successfully');
			redirect('/user/studentProfile/' . $studentid);
		} else {
			// echo "false";
			$this->session->set_flashdata('error_message_display', 'Error or processing your request. Please try again');
			redirect('/user/studentProfile/' . $studentid);
		}
	}

	public function verification($step = 1)
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}
		if ($step == 1) {
			$vals = array(
				'img_path'      => './captcha/',
				'img_width'     => '250',
				'img_height'    => 50,
				'font_path'			=> '../../assets/bootstrap/fonts/glyphicons-halflings-regular.ttf',
				'font_size'     => 16,
				'img_url'       => 'http://localhost/datcportal/captcha/'
			);
			$cap = create_captcha($vals);

			$data_cap = array(
				'captcha_time'  => $cap['time'],
				'ip_address'    => $this->input->ip_address(),
				'word'          => $cap['word']
			);
			// echo $cap['word'];
			$this->user_model->addCaptcha($data_cap);
			// print_r($data);
			// show form
			$data['cap'] = $cap;
			$this->load->view('verfication-view', $data);
		} else if ($step == 2 && isset($_POST)) {
			$expiration = time() - 7200; // Two hour limit
			// print_r($_POST);
			$form_captcha = array(
				'string'	=> $_POST['captcha'],
				'ip' => $this->input->ip_address(),
				'time' => $expiration
			);
			$result_captcha = $this->user_model->validateCaptcha($form_captcha);
			if ($result_captcha == 1) {
				// echo "capctcha is correct";
				$data['result_certificate'] = $this->user_model->readCertificate($_POST['certificatenumber']);
				$data['certificatenumber'] = $_POST['certificatenumber'];

				$this->load->view('certificate-view', $data);
			} else {
				$this->session->set_flashdata('error_message_display', 'You must submit the word that appears in the image.');
				redirect('/user/verification/1');
			}
		}
	}

	/**
	 * Logout module 
	 */

	public function logoutUser($user, $message = "")
	{

		// Removing session data
		if ($user == 'student' || $user == 'trainer') {
			$this->session->unset_userdata('user_detail');
			if ($message == 'updatepsw') {
				$data['success_message_display'] = 'Password updated successfuly please login';
			} else {
				$data['success_message_display'] = 'Log out sucessfully';
			}

			$this->load->view('login', $data);
		} elseif ($user = 'coordinator' || $user = 'admin') {
			$this->session->unset_userdata('user_detail');
			if ($message == 'updatepsw') {
				$data['success_message_display'] = 'Password updated successfuly please login';
			} else {
				$data['success_message_display'] = 'Log out sucessfully';
			}

			$this->load->view('staff-login', $data);
		}
	}


	public function studentProfileUpdate()
	{
		print_r($_POST);
		if (isset($_POST)) {
			$data = array(
				'student_id' => $_POST['studentid'],
				'first_name' => $_POST['fname'],
				'last_name' => $_POST['lname'],
				'email' => $_POST['email'],
				'telephone' => $_POST['telephone'],
				'birth_date' => $_POST['bdate'],
				'state' => $_POST['studentstate']
			);
		}
		$result = $this->user_model->updateStudent($data);
		if ($result == 1) {
			$this->session->set_flashdata('success_message_display', 'Student details update successfully');
			redirect('/user/studentProfile/' . $data['student_id']);
		} else if ($result == 0) {
			$this->session->set_flashdata('success_message_display', 'All upto date');
			redirect('/user/studentProfile/' . $data['student_id']);
		} else {
			$this->session->set_flashdata('error_message_display', 'Error occoured try again');
			redirect('/user/studentProfile/' . $data['student_id']);
		}
	}

	public function studentBatchUpdate()
	{
		// print_r($_POST);
		$data = array(
			'student_id' => $_POST['studentid'],
			'batch_id' => $_POST['batchid'],
			'state' => $_POST['studentstate'],
		);

		$result = $this->user_model->studentBatchUpdate($data);
		if ($result == 1) {
			$this->session->set_flashdata('success_message_display', 'Student batch details update successfully');
			redirect('/user/studentProfile/' . $data['student_id']);
		} else if ($result == 0) {
			$this->session->set_flashdata('success_message_display', 'All upto date');
			redirect('/user/studentProfile/' . $data['student_id']);
		} else {
			$this->session->set_flashdata('error_message_display', 'Error occoured try again');
			redirect('/user/studentProfile/' . $data['student_id']);
		}
	}

	/**
	 * register student register to a new course
	 */

	public function newRegistrationCourse($step = '1', $studentid = 0)
	{
		// echo $step;

		/**
		 * step one -  select course
		 * step two - select batch and payment type
		 * step three - student details
		 */
		if ($step == '1' && isset($studentid)) {

			$success = $this->session->flashdata('success_message_display');
			$student_details = $this->session->flashdata('student_details');
			$error = $this->session->flashdata('error_message_display');
			if (!empty($success) && !empty($student_details)) {
				$data['success_message_display'] = $success;
				$data['student_details'] = $student_details;
			} else if (!empty($success)) {
				$data['success_message_display'] = $success;
			}
			if (!empty($error)) {
				$data['error_message_display'] = $error;
			}
			// get all courses into drop down
			$data['all_courses'] = $this->user_model->read_all_active_courses();
			$data['student_id'] = $studentid;
			//  print_r($data);

			$this->load->view('new-course-registerstudent', $data);
		}
		if ($step == '2' && $studentid == 0) {
			//  print_r($_POST);
			$data['student_detail'] = $this->user_model->student_detail_byid($_POST['studentid'])[0];
			$data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course']);
			// print_r($course_details[0]);
			$data['all_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			//  print_r($data);
			$this->load->view('new-course-registerstudent', $data);
		}
		if ($step == '3') {
			// submission
			// print_r($_POST);
			// Array ( [course-id] => 1 [selected_batch] => 2 [payment_mode] => full [due-date] => 2022-02-08 [firstname] => roshi [lastname] => fernando [bdate] => 2007-06-05 [email] => roshi@gmail.com [telephone] => 1234567 [password] => 71160457V )


			$this->form_validation->set_rules('selected_batch', 'Batch Number', 'trim|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('telephone', 'Contact', 'trim|required');
			//  $this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				//  print_r($_POST);
				$data['student_detail'] = $this->user_model->student_detail_byid($this->input->post('studentid'))[0];
				$data['select_course'] = $this->user_model->read_active_course_byid($_POST['course-id']);

				$data['all_batches'] = $this->user_model->read_active_batch($_POST['course-id']);
				$this->load->view('new-course-registerstudent', $data);
			} else {
				$data_student = array(
					'student_id' => $this->input->post('studentid'),
					'first_name' => $this->input->post('firstname'),
					'last_name' => $this->input->post('lastname'),
					'birth_date' => $this->input->post('bdate'),
					'email' => $this->input->post('email'),
					'telephone' => $this->input->post('telephone'),
					'staff_id' => $this->session->userdata('user_detail')['user_id'],
					'state' => 'active',


				);
				$data_course_batch = array(
					'batch_id' => $this->input->post('selected_batch'),
					'staff_id' => $this->session->userdata('user_detail')['user_id'],
					'added_date' => Date('Y-m-d'),
					'state' => 'active',
					'certificate_no' => NuLL
				);
				$pay_type = ($this->input->post('payment_mode') == 'full') ? '1' : '2';
				$payment_detail = array(
					'payment_mode' => $this->input->post('payment_mode'),
					'pay_type' => $pay_type,
					'fullpayment' => $this->input->post('fullpayment'),
					'installmentone' => $this->input->post('installmentone'),
					'installmenttwo' => $this->input->post('installmenttwo'),
					'due-date' => $this->input->post('due-date')
				);



				$registration_details = $this->user_model->register_student_new_course($data_student, $data_course_batch, $payment_detail);
				//  echo "<hr>";
				if ($registration_details == 'email found') {
					$data['error_message_display'] = "Student new course registration fail. User with the same email exist!";
					$this->load->view('student-first-payment-confirmation', $data);
				} else {
					$student_batch_payment = array_merge($data_student, $data_course_batch, $payment_detail, $registration_details);
					// print_r($student_batch_payment);
					//  $data['success_message_display'] = "Student registered to the new course successfully";
					//  $data['student_detail'] = $student_batch_payment;
					//  $this->load->view('student-first-payment-confirmation', $data);


					$data['student_detail'] = $student_batch_payment;

					$this->session->set_flashdata('success_message_display', 'Student registered to the new course successfully');
					$this->session->set_flashdata('student_details', $data);
					redirect('/user/newRegistrationCourse/1/' . $data_student['student_id']);
				}
			}
		}
	}
	public function myCourse()
	{
		// print_r($this->session->userdata('user_detail')['user_id']);
		$enrol_courses = $this->user_model->student_wise_batches_course($this->session->userdata('user_detail')['user_id']);
		// print_r($enrol_courses);
		if ($enrol_courses) {
			$data['enrol_courses'] = $enrol_courses;
			$this->load->view('my-courses', $data);
		} else {
			$data['enrol_courses'] = 'No course found';
		}
	}

	public function myAttendance()
	{
		$enrole_courses = $this->user_model->student_wise_batches_course($this->session->userdata('user_detail')['user_id']);


		if ($enrole_courses) {
			foreach ($enrole_courses as $key => $enrole_course) {
				// print_r($enrole_course);
				$enrole_courses[$key]->attendance = $this->attendance_model->read_student_batchwise_attendance($enrole_course->batch_id, $enrole_course->student_id);
			}

			$data['enrol_courses'] = $enrole_courses;
			$this->load->view('my-attendance', $data);
		} else {
			$data['enrol_courses'] = 'No course found';
		}
	}
	/**
	 * view staff registration page 
	 * 
	 */
	public function newStaffRegistration()
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}
		if (isset($data)) {
			$this->load->view('staff-registration', $data);
		} else {
			$this->load->view('staff-registration');
		}
	}

	public function addNewStaff()
	{
		$this->form_validation->set_rules('name', 'Member name', 'trim|required');



		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('staff-registration');
		} else {

			$data_staff = array(
				'staff_name' => $this->input->post('name'),

				'email' => $this->input->post('email'),
				'role_type' => $this->input->post('role'),
				'password' => sha1($this->input->post('password')),
				'state' => 'active',


			);
			// print_r($data_student);
			$result_registration = $this->user_model->add_new_staff($data_staff);
			if ($result_registration == 1) {


				$this->session->set_flashdata('success_message_display', 'Staff registered successfully');
				redirect('/user/newStaffRegistration');
			} else {
				$data['error_message_display'] = "Registration Fail";
				$this->load->view('staff-registration', $data);

				$this->session->set_flashdata('error_message_display', 'Registration Fail. Try again.');
				redirect('/user/newStaffRegistration');
			}
		}
	}

	/**
	 * search trainer base on the text send
	 */
	public function searchStaff()
	{
		$success = $this->session->flashdata('success_message_display');
		$error = $this->session->flashdata('error_message_display');
		$data = array();
		if (!empty($success)) {
			$data['success_message_display'] = $success;
		}
		if (!empty($error)) {
			$data['error_message_display'] = $error;
		}
		// show default staff search page
		if (isset($_POST['search-text']) && isset($_POST['type'])) {
			// print_r($_POST);
			$staff_search_result = $this->search_model->search_staff($_POST);

			// if found staff
			if ($staff_search_result == 0) {
				$data = array(
					'error_message_display'  => 'No result found',
					'search_input' => $_POST
				);
				$this->load->view('staff-search-view', $data);
			} else {
				$data = array(
					'success_message_display' => 'Found result',
					'search_result' => $staff_search_result,
					'search_input' => $_POST
				);
				$this->load->view('staff-search-view', $data);
			}
		} else {
			$this->load->view('staff-search-view', $data);
		}
	}

	public function reset($id, $role)
	{
		if (isset($id) && isset($role)) {
			$reset_passowrd = sha1('abc123');
			$result = $this->user_model->resetPassword($id, $role,	$reset_passowrd);
			$this->session->set_flashdata('success_message_display', 'Password Reset New Password - abc123');
			if ($role == 'staff') {
				redirect('/user/searchStaff');
			} else if ($role == 'trainer') {
				redirect('/trainer/searchTrainer');
			} else if ($role == 'student') {
				redirect('/user/searchStudent');
			}
		}
	}
	public function staffupdate($id, $state)
	{
		if (isset($id) && isset($state)) {

			$result = $this->user_model->updaeState($id, $state);
			$this->session->set_flashdata('success_message_display', 'State update to ' . $state);
			redirect('/user/searchStaff');
		}
	}

	// show trainer assign course and batches

	public function trainerCourse()
	{
		// print_r($this->session->userdata['user_detail']);
		if (isset($this->session->userdata['user_detail']['type']) == 'trainer') {

			$data['trainer_batch_details'] = $this->trainer_model->get_trainer_batch_details($this->session->userdata['user_detail']['user_id']);
			// print_r($trainer_batch_details);
			$this->load->view('trainer-course-view', $data);
		}
	}
}
