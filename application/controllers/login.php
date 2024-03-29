<?php 
Class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');
	}

    public function index(){
        $this->load->view('register');
    }
    // userlogin method

    public function userlogin(){
        
        $success = $this->session->flashdata('success');
		$error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        if(isset($data['error']) || isset($data['success'])){
            $this->load->view('login',$data);
        }else{
            if($this->checkSessionExist()){
                $this->load->view('profile');
            }else{
                $this->load->view('login',$data);
            }
        }
        
      
    }

    public function registerSubmit(){
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE){
                        $this->load->view('register');
                }
                else{
                    echo "success";
                    // print_r($_POST);
                    $current_date = date('Y-m-d');
                    // associative array
                    $data = array(
                       'id'=>NULL,
                       'name'=>$_POST['name'],
                       'email'=> $_POST['email'],
                       'password'=> $_POST['password'],
                       'address' => $_POST['address'],
                       'created_date' =>  $current_date
                    );

                    // print_r($data);
                    // pass this array to model
                    $result = $this->user_model->registerUser($data);
                    if($result){
                        $data = array(
                            'success'=>'User Register Successfuly'
                        );
                        $this->load->view('register',$data);
                    }else{
                        $data = array(
                            'error'=>'User Exist with this Email. Please try again'
                        );
                        $this->load->view('register',$data);
                    }
                   

                        // $this->load->view('formsuccess');
                }
    }
    public function loginSubmit(){
        print_r($_POST);
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('login');
        }else{
            $data = array(
                'email'=> $_POST['email'],
                'password'=> $_POST['password'],
             );
             $result = $this->user_model->loginCheck($data);
             if($result){
                // set session 
                $resutlUserData = $this->user_model->getUserData($data);
                print_r($resutlUserData);
                $session_user = array(
                    'id'=> $resutlUserData[0]->id,
                    'login'=> true,
                    'name' => $resutlUserData[0]->name
                );
                if($resutlUserData[0]->role == 'admin'){
                    $actions = array(
                        'dashboard'=>['myprofile'=>true,
                                        'teamprofile'=>true,
                                        'product'=>true,
                                        'reports'=>true
                            ],
                        'profile'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>true
                        ],
                        'teamprofile'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>true
                        ],
                        'product'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>true
                                    ],
                        'reports'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>true
                                    ],

                    );
                }elseif($resutlUserData[0]->role == 'coordinator'){
                    $actions = array(
                        'dashboard'=>['myprofile'=>true,
                                        'teamprofile'=>true,
                                        'product'=>true,
                                        'reports'=>false
                            ],
                        'profile'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>false
                                    ],
                        'teamprofile'=>['view'=>true,
                                    'edit'=>false,
                                    'delete'=>false
                                    ],
                        'product'=>['view'=>true,
                                    'edit'=>true,
                                    'delete'=>false
                                    ],
                        'reports'=>['view'=>false,
                                    'edit'=>false,
                                    'delete'=>false
                                    ],
                    );
                }
                
                // update session object with new session data
                $this->session->set_userdata('userinfo', $session_user);
                $this->session->set_userdata('routing', $actions);
                redirect('/login/dashboard');
             }else{
                // $data = array(
                //     'error'=>'Email or password incorrect. Please check'
                // );
                // $this->load->view('login',$data);
                $this->session->set_flashdata('error','Email or password incorrect. Please check');
                redirect('login/userlogin');

             }

        }
    }

    public function dashboard(){
        $success = $this->session->flashdata('success');
		$error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        $this->load->view('dashboard',$data);
        
    }
    public function profile(){
        $success = $this->session->flashdata('success');
		$error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        $sessionData = $this->session->userdata('userinfo');
        // print_r($sessionData);
        if($this->checkSessionExist()){

            $result = $this->user_model->getUserDataByID($sessionData['id']);
            if($result){
                $data['myprofile'] = $result;
                $this->load->view('profile',$data);
            }
            
        }
        
    }
    public function editProfile($id){
        $success = $this->session->flashdata('success');
		$error = $this->session->flashdata('error');
        $data = [];
        if (!empty($success)) {
            $data['success'] = $success;
        }
        if (!empty($error)) {
            $data['error'] = $error;
        }
        if($this->checkSessionExist()){

            $result = $this->user_model->getUserDataByID($id);
            if($result){
                $data['myprofile'] = $result;
                $this->load->view('edit-profile',$data);
            }
            
        }
    }
    public function editProfileSubmit(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error','Form details cannot be empty');
            redirect("/login/editProfile/{$_POST['userid']}");
        }else{
            print_r($_POST);
            $data = array(
                'id'=>$_POST['userid'],
                'name'=>$_POST['username'],
                'email'=> $_POST['email'],
                'address' => $_POST['address']
             );
             $result = $this->user_model->updateProfile($data);
             if($result == 1){
                $this->session->set_flashdata('success','Profile data updated successfully');
                redirect("/login/profile/");
             }elseif($result == 0){
                $this->session->set_flashdata('success','Profile data upto date');
                redirect("/login/profile/");
             }else{
                $this->session->set_flashdata('error','Error occured Please try again');
                redirect("/login/editProfile/{$_POST['userid']}");
             }

        }

       

    }
    private function checkSessionExist(){
        if(!$this->session->has_userdata('userinfo')){
            $this->session->set_flashdata('error','Please login first to access the page');
            redirect('login/userlogin');
        }else{
            return true;
        }
    }

    public function logout(){
        $this->session->unset_userdata('userinfo');
        $this->session->set_flashdata('success','Logout successfully');
            redirect('login/userlogin');
        
    }
}
