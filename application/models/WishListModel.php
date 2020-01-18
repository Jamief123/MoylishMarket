<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WishListModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }


    public function InsertItem($product)
	{	$this->db->insert('wishlist',$product);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function get_all_items($customerNumber) 
	{ 	
		$this->db->select("*"); 
		$this->db->from('wishlist');
		$this->db->where('customerNumber',$customerNumber);
		$query = $this->db->get();
		return $query->result();
	}


}
?>