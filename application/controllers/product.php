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

		$this->load->model('Product_model');
		$this->load->library('upload');
	}

	public function index()
	{
		$this->load->view('/product/product_view');
	}

	public function addNewCategory()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('product/product_view');
		} else {
			echo "success";
			// print_r($_POST);
			$current_date = date('Y-m-d');
			// associative array

			// print_r($data_product);
			// pass this array to model
			// $this->load->view('formsuccess');
		}

		print_r($_FILES);
		// print_r($_POST);
		$new_name = time() . $_FILES["userfile"]['name'];

		$data_product = array(
			'id' => NULL,
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'image' => $new_name,
			'created_date' =>  $current_date
		);

		$config = array(
			'upload_path' => './uploads/image/',
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
			echo "success";
			$result = $this->Product_model->addproduct($data_product);
			if ($result) {
				$data_product = array(
					'success' => 'Product Added Successfully'
				);
				$this->load->view('product/product_view', $data_product);
			} else {
				$data_product = array(
					'error' => 'Product Exist. Please try again'
				);
				$this->load->view('product/product_view', $data_product);
			}
		} else {
			$error = array('error' => $this->upload->display_errors());
			//echo $config['upload_path'];
			print_r($error);
			//$this->load->view('custom_view', $error);
		}
	}

	public function showpdf(){
		result = $this->product_model->getMarks();

		$html = "<table width='100%'><tr><td><h3 style='margin-bottom:0; padding-bottom:0;'>Create Tech Academy</h3><p style='margin-top:0;padding-top:0;'>Phone: +94 76 435 4222 | Email: info@cta.lk</p></td><td align='right'>Date Issued<br>";
		$html .= date("F j, Y");
		$html .= "</td></tr></table> <hr>";
		//echo $html;

		$html .= "<table border='1' style='width:100%; border: 1px black solid '

		$customerPaper = array(0, 0, 500, 500);
		$this->load->library('pdf');
		$this->dompdf->loadhtml($html); // load all html and css contents in view
		// $this->dompdf->setPaper('A4', 'landscape');
		// $this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->setpaper($customerPaper, 'landscape'); // set pdf paper size and orientation
		$this->dompdf->render(); // its convert all html & css elements to pdf
		$this->dompdf->stream("sample.pdf", array("Attachment" => 0)); // used to output generated in browser and its automatically download the pdf
	}
}
