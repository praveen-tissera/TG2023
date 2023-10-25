<?php



class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
        $this->load->model('product_model');
    }

    public function index(){
        $error = $this->session->flashdata('error');
        $message = $this->session->flashdata('message');

        if(!empty($error))
            $data['error'] = $error;
        if(!empty($message))
            $data['message'] = $message;

        $data['products'] = $this->product_model->getProducts();
        $this->load->view('product/index', $data);
    }


    public function getProduct($idp = null){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = $this->product_model->getProductById($id);
            
            if(!empty($result)){
                $data = array('name' => $result->name, 'description' => $result->description, 'image' => $result->image);
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        }else if(!empty($idp)){
            $result = $this->product_model->getProductById($idp);
            
            if(!empty($result)){
                $data = array('name' => $result->name, 'description' => $result->description, 'image' => $result->image);
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        }
    }

    public function saveImage(){
        if (isset($_POST['image'])) {
            $this->session->set_flashdata('message', 'New product added.');
            $data = $_POST['image'];
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = str_replace(' ', '+', $data);
            $decodedData = base64_decode($data);
            $filename = 'image_' . $_POST['filename'] . '.png'; // Generate a unique filename
            $file = fopen('images/products/'.$filename, 'wb');
            if ($file !== false) {
                if (fwrite($file, $decodedData)) {
                    fclose($file);
                    echo 'Image uploaded successfully.';
                } else {
                    echo 'Failed to save the image.';
                }
            } else {
                echo 'Unable to open file for writing.';
            }
        } else {
            echo 'No image data received.';
        }
    }

    public function add(){
        if(!(isset($_POST['name']) && isset ($_POST['description']))){
            $this->session->set_flashdata('error', 'specify the fields first');
            redirect('/product');
        }
        if(!empty($_FILES['image']['name'])){

            $filename = time().$_FILES['image']['name'];

            $config['upload_path'] = 'images/products/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('image')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('/product');
            }

            $data['image'] = $filename; 

        } elseif (isset($_POST['filename'])) {
            $data['image'] = $_POST['filename'];
        } 
        else{
            $this->session->set_flashdata('error', 'Upload a product image !');
            redirect('/product');
        }
        
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        

        if($this->product_model->addProduct($data))
            $this->session->set_flashdata('message', 'New product added.');
        else
            $this->session->set_flashdata('error', 'Something went wrong');
        
        redirect('/product');
    }

    public function edit(){
        if(!(isset($_POST['name']) && isset ($_POST['description']))){
            $this->session->set_flashdata('error', 'specify the fields first');
            redirect('/product');
        }

        if(!empty($_FILES['image']['name'])){

            $filename = time().$_FILES['image']['name'];

            $config['upload_path'] = 'images/products/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('image')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('/product');
            }

            $data['id'] = $_POST['id'];
            $data['name'] = $_POST['name'];
            $data['description'] = $_POST['description'];
            $data['image'] = $filename;

            if($this->product_model->updateProduct($data, true))
                $this->session->set_flashdata('message', 'Product details updated.');
            else
                $this->session->set_flashdata('error', 'Something went wrong');
        }

        //keep the initial product image
        if($this->product_model->updateProduct($_POST))
            $this->session->set_flashdata('message', 'Product details updated.');
        else
            $this->session->set_flashdata('error', 'Something went wrong');

        redirect('/product');
    }

    public function remove(){
        
        if(isset($_POST['id'])){
            $this->product_model->removeProduct($_POST['id']);
            $this->session->set_flashdata('message', 'Product removed.');
        }else
            $this->session->set_flashdata('error', 'No direct access');

        redirect('/product');
    }
}

?>