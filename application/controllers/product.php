<?php

class Product extends CI_Controller
{
	public function __construct()
	{
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
		$this->load->model('product_model');

		$this->load->library('upload');
		$this->load->library('pagination');
	}

	public function index()
	{
		$this->load->view('/product/product_select');
	}

	public function addNewCategory()
	{
		// print_r($_FILES);
		// print_r($_POST);
		$current_date = date('Y-m-d');

		$new_name = time() . $_FILES["userfile"]['name'];
		$new_name = str_replace(' ', '-', $new_name);

		$config = array(
			'upload_path' => './images/food',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024",
			'file_name' => $new_name
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload()) {
			$data = array('upload_data' => $this->upload->data());
			echo "sucess";
			$productdata = array(
				'id' => NULL,
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'created_date' =>  $current_date,
				'image' => $new_name
			);
			print_r($productdata);
			$this->db->insert('product_tbl', $productdata);
			$this->load->view('product/product_select');
		} else {
			$error = array('error' => $this->upload->display_errors());
			//echo $config['upload_path'];
			print_r($error);
			//$this->load->view('custom_view', $error);


		}
	}
	public function product_select()
	{
		//sends title to model and gets product data
		$title = $_POST['title'];
		$this->load->model('product_model');
		$result = $this->product_model->read_product_data($title);


		if ($result) {
			print_r($result);
			$data['product_info'] = $result;
			$this->load->view('product/product_view', $data);
		} else {
			$data = array(
				'error' => 'Invalid title. Please try again'
			);
			$this->load->view('product_select', $data);
		}
	}


	public function product_create()
	{
		//loads product_create view
		$this->load->view('/product/product_create');
	}

	public function getAllProducts($offset = 0)
	{
		$config = array();
		$config['base_url'] = base_url() . 'product/getAllProducts';
		$config['total_rows'] = $this->product_model->get_count();
		$config['per_page'] = 1;
		//Ecapsulation pagination
		$config['full_tag_open'] = '<ul class="pagination justify-content-center';
		$config['full_tag_close'] = '</ul>';
		//First link
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		//Customizing the "Digit" Link
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		//previous page set up
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		//Last page
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		//Next page
		$config['next_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';


		$config['attributes'] = ['class' => 'page-link'];

		//curent page
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link >';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';


		$this->pagination->initialize($config);


		$data['links'] = $this->pagination->create_links();
		$data['items'] = $this->product_model->getAllProducts($config['per_page'], $offset);

		$this->load->view('/product/product_viewall', $data);
	}
}
