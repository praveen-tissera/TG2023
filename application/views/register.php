<?php

//session_start(); //we need to start session in order to access it through CI
//domain/User_Authentication/user_registration_show/5
Class User_Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_database');
	}

	// Show login page
	public function index() {
			$this->load->view('contactus');
			
	}

	// Show registration page
	public function user_registration_show() {
	$this->load->view('registration_form');
	}

<<<<<<< Updated upstream
	// Validate and store registration data in database
	public function new_user_registration() {
=======
                <h1>Register New User</h1>
                <?php echo validation_errors('<div class="alert alert-danger ">','</div>'); ?>
>>>>>>> Stashed changes

		
	}

	// Check for user login process
	public function user_login_process() {

		
	}

	// Logout from user page
	public function logout() {

	}
		
		

}

?>