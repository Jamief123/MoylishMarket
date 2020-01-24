<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('WishListModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('cart');
	}

	public function viewProduct($produceCode){
		//function to check if product is discontinued.
		//if it is discontinued do not display product.
		if($this->ProductModel->isProductDiscontinued($produceCode)[0]['discontinued'] == 0){
			$data['view_data']= $this->ProductModel->drilldown($produceCode);
			$this->load->view('ProductView', $data);
		}else{
			$data['message'] = "Sorry that product is discontinued";
			$this->load->view('displayMessageView',$data);
		}
    }


    public function findProducts()
    {

    	$data['view_data']= $this->ProductModel->findProducts($this->input->get('productSearch'));
    	$this->load->view('productSearchView', $data);
    }

    public function handleInsert()
    {
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

	public function uploadAndResizeFile()
	{	
		//set config options for thumbnail creation
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
		$config['width']='345';
		$config['height']='186';

		$this->load->library('image_lib',$config);
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'image resized<br>';
			
		$this->image_lib->clear();
		return $path;
	}
	
	public function createThumbnail($path)
	{	
		//set config options for thumbnail creation
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
	{	
		$data['product_info']=$this->ProductModel->get_all_products();
		$this->load->view('index',$data);
	}


	public function deleteProduct($produceCode){
		$deletedRows = $this->ProductModel->deleteProductModel($produceCode);
		if($deletedRows > 0)
			$data['message'] = "$deletedRows product has been deleted";
		else
			$data['message'] = "There was an error deleting the product with a produce code of $produceCode";
		$this->load->view('displayMessageView',$data);
	}

	public function discontinueProduct($produceCode){
		if($this->ProductModel->discontinueProductModel($produceCode))
			redirect('DefaultController/Index');
		else
			$data['message'] = "There was a problem updating the record";
		$this->load->view('displayMessageView',$data);
	}

	public function editProduct($produceCode)
    {	
    	$data['edit_data']= $this->ProductModel->drilldown($produceCode);
		$this->load->view('updateProductView', $data);
    }


	public function updateProduct($produceCode)
    {	
    	$pathToFile = $this->uploadAndResizeFile();
		$this->createThumbnail($pathToFile);

		//set validation rules
		$this->form_validation->set_rules('produceCode', 'produceCode', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('productLine', 'productLine', 'required');	
		$this->form_validation->set_rules('supplier', 'supplier', 'required');
		$this->form_validation->set_rules('quantityInStock', 'quantityInStock', 'required');
		$this->form_validation->set_rules('bulkBuyPrice', 'bulkBuyPrice', 'required');
		$this->form_validation->set_rules('bulkSalePrice', 'bulkSalePrice', 'required');
		$this->form_validation->set_rules('discontinued', 'discontinued', 'required');
	
		//get values from post
		$produceCode = $this->input->post('produceCode');
		$aProduct['description'] = $this->input->post('description');
		$aProduct['productLine'] = $this->input->post('productLine');
		$aProduct['supplier'] = $this->input->post('supplier');
		$aProduct['quantityInStock'] = $this->input->post('quantityInStock');
		$aProduct['bulkBuyPrice'] = $this->input->post('bulkBuyPrice');
		$aProduct['bulkSalePrice'] = $this->input->post('bulkSalePrice');
		$aProduct['discontinued'] = $this->input->post('discontinued');
		$aProduct['photo'] = $_FILES['userfile']['name'];

		//check if the form has passed validation
		if (!$this->form_validation->run()){
			//validation has failed, load the form again
			$this->load->view('updateProductView', $aProduct);
			return;
		}

		
		//check if update is successful
		if ($this->ProductModel->updateProductModel($aProduct, $produceCode)) {
			redirect('DefaultController/index');
		}
		else {
			$data['message']="Uh oh ... problem on update";
		}
    }

    public function addToBasket(){
    	$produceCode = $this->input->post('produceCode');
    	$quantity = $this->input->post('quantity');
    	$description = $this->input->post('description');
		
	    if($quantity>=1){
	        $quanity = ceil($quantity);
	    }else{
	        $quantity = 1;
	    }

	    if($this->checkStock($quantity, $produceCode)){

    		$query = $this->ProductModel->getPrice($produceCode);
			$price = $query[0]['bulkSalePrice'];

		    $item = array(
		        'id'      => $produceCode,
		        'qty'     => $quantity,
		        'price'   => $price,
		        'name'    => $description
			);

			$this->cart->insert($item);
		    $this->load->view('basketView');
    	}else{
    		$data['message'] = 'Sorry we do not have that many in stock';
    		$this->load->view('displayMessageView',$data);
    	}

		
    }

    public function viewBasket(){
    	$this->load->view('basketView');
    }

    public function viewWishlist(){
    	if(isset($_SESSION['logged_in'])){
    		//get wishlist items from db
	    	$data['view_data'] = $this->WishListModel->get_all_items($_SESSION['logged_in']['customerNumber']);
	    	//load view
	    	$this->load->view('wishlistView',$data);
    	}else{
    		$data['message'] = "Sorry you must be logged in to do that";
    		$this->load->view('displayMessageView',$data);
    	}
    	
    }


    public function checkStock($quantity, $produceCode){

    	$query =  $this->ProductModel->getQuantity($produceCode);
    	$quantityInStock = $query[0]['quantityInStock'];
    	$quantityInStock;
    	if($quantity>$quantityInStock){
    		return false;
    	}else
    		return true;
    }

    function updateBasket(){
    	$updateItem = array();

    	foreach( $_POST as $cartItem ) {
    		$updateItem['rowid'] = $cartItem['rowid'];
    		$updateItem['qty'] = $cartItem['qty'];
    		$this->cart->update($updateItem);
        }
        $this->load->view('basketView');
    } 

    public function category(){
    	$category = $this->input->get('category');

    	$data['product_info']=$this->ProductModel->get_all_products_category(20,$this->uri->segment(3), $category);
		$data['category'] = $this->ProductModel->get_all_categories();
		$this->load->view('index',$data);
    }
    
    public function checkout(){
    	$this->load->view('checkout');
    }

    public function addToWishlist(){
    	if(isset($_SESSION['logged_in'])){
    		$aProduct['customerNumber'] = $_SESSION['logged_in']['customerNumber'];
	    	$aProduct['produceCode'] = $this->input->post('produceCode');
			$aProduct['description'] = $this->input->post('description');
			$aProduct['photo'] = $this->input->post('photo');
	    	$this->WishListModel->InsertItem($aProduct);
	    	$this->viewWishlist();
    	}else{
    		$data['message'] = "Sorry you must be logged in to do that";
    		$this->load->view('displayMessageView',$data);
    	}
    	
    }

    public function deleteItemFromWishlist($produceCode){
    	$this->WishListModel->deleteWishlistModel($produceCode, $_SESSION['logged_in']['customerNumber']);
    	$this->viewWishlist();
    }
}

