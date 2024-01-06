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
		$this->load->model('product_model');
		$this->load->library("pagination");
    } 

    public function index(){
        $this->load->view('/product/product_view');
    }

    public function addNewCategory(){
		// print_r($_FILES);
		// print_r($_POST);

		$current_date = date('Y-m-d');
		// associative array
		

		$new_name = time().$_FILES["userfile"]['name'];

		$data_product = array(
			'id'=>NULL,
			'title'=>$_POST['title'],
			'description'=> $_POST['description'],
			'image'=> $new_name,
			'created_date' =>  $current_date
		 );

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
		$result = $this->product_model->addProduct($data_product);
		
		}
		else
		{
		$error = array('error' => $this->upload->display_errors());
		//echo $config['upload_path'];
		print_r($error);
		//$this->load->view('custom_view', $error);
		}
	}

	public function getProducts($offset=0){
		$config = array();
		$config["base_url"] = base_url() . "product/getProducts";
		$config["total_rows"] = $this->product_model->get_count();
        $config["per_page"] = 1;

    //Encapsulate whole pagination    
	$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul>';

	//First link of pagination
	$config['first_link']       = 'First';
	$config['first_tag_open']   = '<li class="page-item">';
    $config['first_tag_close']  = '</li>';

	//Customizing the “Digit” Link
	$config['num_tag_open']     = '<li class="page-item">';
    $config['num_tag_close']    = '</li>';

	//For PREVIOUS PAGE Setup
	$config['prev_link']        = 'Prev';
    $config['prev_tag_open']    = '<li class="page-item">';
    $config['prev_tag_close']   = '</li>';

	//For LAST PAGE Setup
	$config['last_link']        = 'Last';
	$config['last_tag_open']   = '<li class="page-item">';
    $config['last_tag_close']  = '</li>';

	//For NEXT PAGE Setup
	$config['next_link']        = 'Next';
	$config['next_tag_open']    = '<li class="page-item">';
    $config['next_tag_close']   = '</li>';
 
   
    $config['attributes']       = ['class' => 'page-link'];


	//For CURRENT page on which you are
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';



	// 
		$this->pagination->initialize($config);

		
		$data["links"] = $this->pagination->create_links();
		$data['items'] = $this->product_model->getAllProducts($config["per_page"], $offset);
		// $result = $this->product_model->getAllProducts();
		// $products['items'] =  $result;
		$this->load->view('/product/product_viewall',$data);
		// print_r($result);

	}
	
	public function getCharts(){
		$result = $this->product_model->getMarks();
		$data['students'] = $result;
		$this->load->view('/chart/charts_view',$data);

	}
	public function showPdf(){
		$result = $this->product_model->getMarks();
	
		$html = "<table width='100%'><tr><td><h3 style='margin-bottom:0;padding-bottom:0;'>Create Tech Academy</h3><p style='margin-top:0;padding-top:0;'>Phone: +94764354222 | Email: info@cta.lk</p></td><td align='right'>Date Issued<br>";
		$html .= date("F j, Y");
		$html .= "</td></tr></table> <hr>";

		$html .= "<table border='1' style='width:100%;border:1px black solid;border-collapse: collapse;margin-bottom:50px;'><tr><th style='padding:10px;' >Student Name</th><th style='padding:10px;'>Science Marks</th><th style='padding:10px;'>Math Marks</th></tr>";
		foreach ($result as $key => $value) {
			$html .= "<tr><td style='padding:10px;'>{$value->name}</td><td style='padding:10px;text-align:center'>{$value->math_marks}</td><td style='padding:10px;text-align:center'>{$value->science_marks}</td></tr>";
		};
		$html .= "</table>";

		$customePaper = array(0, 0, 500, 500);
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html); // load all html and css contents in view
		// $this->dompdf->setPaper('A4', 'landscape');
		// $this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->setPaper($customePaper, 'landscape'); // set pdf paper size and orientation
		$this->dompdf->render(); // its convert all html & css elements to pdf
		$this->dompdf->stream("sample.pdf", array("Attachment" => 0)); //used to output generated in broswer and its automatically download the pdf

		

	}
	public function searchReceipe(){
	
		$this->load->view('/api/receipe-search');

	}

}