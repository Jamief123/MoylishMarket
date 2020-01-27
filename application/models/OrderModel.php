<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }


    public function insertOrderModel($order)
	{	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE;     //set this to false to prevent DB errors from showing up for user

		$this->db->insert('orders',$order);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}

		$this->db->db_debug = $db_debug; //set it back to original setting
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