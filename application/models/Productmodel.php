<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }
	
	// function insertTitleModel($title)
	// {	$this->db->insert('titles',$title);
	// 	if ($this->db->affected_rows() ==1) {
	// 		return true;
	// 	}
	// 	else {
	// 		return false;
	// 	}
	// }

	function get_all_products() 
	{	$this->db->select("*"); 
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}

	function findProducts($keyword){
		$this->db->select("*"); 
		$this->db->from('products');
		$this->db->where('description', $keyword)
		$query = $this->db->get();
		return $query->result();
	}
	
	// public function deleteTitleModel($ISBN)
	// {	$this->db->where('ISBN', $ISBN);
	// 	return $this->db->delete('titles');
 //    }

	// function updateTitleModel($author,$ISBN)
	// {	$this->db->where('ISBN', $ISBN);
	// 	return $this->db->update('titles', $author);
	// }

	public function drilldown($produceCode)
	{	$this->db->select("*"); 
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result();
    }

}
?>