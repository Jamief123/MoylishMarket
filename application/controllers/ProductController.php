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
	}

	public function viewProduct($produceCode){
		$data['view_data']= $this->ProductModel->drilldown($produceCode);
		$this->load->view('ProductView', $data);
    }

    public function findProducts($keyword){
    	$data['view_data']= $this->ProductModel->findProducts($keyword);
    	$this->load->view('ProductSearchView', $data);
    }

	// public function listProducts() 
	// {	$data['product_info']=$this->ProductModel->get_all_products();
	// 	$this->load->view('index',$data);
	// }


	

}

