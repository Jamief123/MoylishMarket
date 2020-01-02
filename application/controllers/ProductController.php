<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
	}

	public function viewProduct($produceCode){
		$data['view_data']= $this->ProductModel->drilldown($produceCode);
		$this->load->view('ProductView', $data);
    }

    public function findProducts(){
    	$data['view_data']= $this->ProductModel->findProducts($this->input->get('productSearch'));
    	$this->load->view('productSearchView', $data);
    }

    public function handleInsert(){
		if ($this->input->post('submitInsert')){

			$pathToFile = $this->uploadAndResizeFile();
			$this->createThumbnail($pathToFile);
		
			//set validation rules
			$this->form_validation->set_rules('produceCode', 'Produce Code', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('productLine', 'Product Line', 'required');	
			$this->form_validation->set_rules('supplier', 'Supplier', 'required');
			$this->form_validation->set_rules('quantityInStock', 'Quantity In Stock', 'required');
			$this->form_validation->set_rules('bulkBuyPrice', 'Bulk Buy Price', 'required');
			$this->form_validation->set_rules('bulkSalePrice', 'Bulk Sale Price', 'required');
			//$this->form_validation->set_rules('image', 'Image', 'required');

			//get values from post
			$aProduct['produceCode'] = $this->input->post('produceCode');
			$aProduct['description'] = $this->input->post('description');
			$aProduct['productLine'] = $this->input->post('productLine');
			$aProduct['supplier'] = $this->input->post('supplier');
			$aProduct['quantityInStock'] = $this->input->post('quantityInStock');
			$aProduct['bulkBuyPrice'] = $this->input->post('bulkBuyPrice');
			$aProduct['bulkSalePrice'] = $this->input->post('bulkSalePrice');
			$aProduct['photo'] = $_FILES['userfile']['name'];
			
			//check if the form has passed validation
			if (!$this->form_validation->run()){
				//validation has failed, load the form again
				$this->load->view('insertProductView', $aProduct);
				echo "Problum";
				return;
			}

			//check if insert is successful
			if ($this->ProductModel->insertProductModel($aProduct)) {
				$data['message']="The insert has been successful";
			}
			else {
				$data['message']="Uh oh ... problem on insert";
			}
			
			//load the view to display the message
			$this->load->view('displayMessageView', $data);
			
			return;
		}else if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){
			$aProduct['produceCode'] = "";
			$aProduct['description'] = "";
			$aProduct['productLine'] = "";
			$aProduct['supplier'] = "";
			$aProduct['quantityInStock'] = "";
			$aProduct['bulkBuyPrice'] = "";
			$aProduct['bulkSalePrice'] = "";
			$aProduct['photo'] = "";

			//load the form
			$this->load->view('insertProductView', $aProduct);
		}else{
			//user is not logged in so just display an error
			$data['message']="You must be logged in as an admin to do that!";
			//load the view to display the message
			$this->load->view('displayMessageView', $data);
		}
	}

	function uploadAndResizeFile()
	{	//set config options for thumbnail creation
		$config['upload_path']='./assets/images/products/full/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']='10000';
		$config['max_width']='10240';
		$config['max_height']='7680';
		
		$this->load->library('upload',$config);
		if (!$this->upload->do_upload())
			echo $this->upload->display_errors();
		else
			echo 'upload done<br>';	
	
		$upload_data = $this->upload->data();
		$path = $upload_data['full_path'];
		
		$config['source_image']=$path;
		$config['maintain_ratio']='FALSE';
		$config['width']='180';
		$config['height']='200';

		$this->load->library('image_lib',$config);
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'image resized<br>';
			
		$this->image_lib->clear();
		return $path;
	}
	
	function createThumbnail($path)
	{	//set config options for thumbnail creation
		$config['source_image']=$path;
		$config['new_image']='./assets/images/products/thumbs/';
		$config['maintain_ratio']='FALSE';
		$config['width']='145';
		$config['height']='75';
		
		//load library to do the resizing and thumbnail creation
		$this->image_lib->initialize($config);
		
		//call function resize in the image library to physiclly create the thumbnail
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'thumbnail created<br>';	
	}

	public function listProducts() 
	{	$data['product_info']=$this->ProductModel->get_all_products();
		$this->load->view('index',$data);
	}


	

}

