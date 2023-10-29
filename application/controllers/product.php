<?php

class Product extends CI_Controller{
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
        
        date_default_timezone_set("Asia/colombo");
	    //	$this->load->model('user_model');
	
		$this->load->library('upload');
		
    } 

    public function index(){
        $this->load->view('/product/product_view');
    }

    public function addNewCategory(){
		// print_r($_FILES);
		// print_r($_POST);
		$new_name = time().$_FILES["userfile"]['name'];
		$config = array(
		'upload_path' => './uploads/image/food/',
		'allowed_types' => "gif|jpg|png|jpeg|pdf",
		'overwrite' => TRUE,
		'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		// 'max_height' => "768",
		// 'max_width' => "1024",
		'file_name' => $new_name
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload())
		{
		$data = array('upload_data' => $this->upload->data());
		echo "sucess";
		
		}
		else
		{
		$error = array('error' => $this->upload->display_errors());
		//echo $config['upload_path'];
		print_r($error);
		//$this->load->view('custom_view', $error);
		}
	}
}