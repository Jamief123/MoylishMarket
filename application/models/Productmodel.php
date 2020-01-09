<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }

	public function get_all_products($limit,$offset) 
	{ //gets all products that are not discontinued
		$this->db->limit($limit,$offset);
		$this->db->select("*"); 
		$this->db->from('products');
		$this->db->where('discontinued',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_products_category($limit,$offset, $category) 
	{ //gets all products that are not discontinued
		$this->db->limit($limit,$offset);
		$this->db->select("*"); 
		$this->db->from('products');
		$this->db->where('discontinued',0);
		$this->db->where('productLine',$category);
		$query = $this->db->get();
		return $query->result();
	}

	public function findProducts($keyword){
		$this->db->select("*"); 
		$this->db->from('products');
		$this->db->like('description', $keyword, 'both');
		$this->db->where('discontinued',0);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function deleteProductModel($produceCode)
	{	$this->db->where('produceCode', $produceCode);
		return $this->db->delete('products');
    }

	function updateProductModel($product,$produceCode)
	{	$this->db->where('produceCode', $produceCode);
		return $this->db->update('products', $product);
	}

	public function drilldown($produceCode)
	{	$this->db->select("*"); 
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result();
    }

    public function record_count(){
    	return $this->db->count_all('products');
    }

    public function insertProductModel($product)
	{	$this->db->insert('products',$product);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function discontinueProductModel($produceCode){
		$this->db->set('discontinued', 1);
		$this->db->where('produceCode',$produceCode);
		return $this->db->update('products');
	}

	public function isProductDiscontinued($produceCode){
		$this->db->select("discontinued");
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPrice($produceCode){
		$this->db->select("bulkSalePrice");
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getQuantity($produceCode){
		$this->db->select("quantityInStock");
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_categories(){
		$this->db->distinct();
		$this->db->select("productLine"); 
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}

}
?>