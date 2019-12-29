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

	function get_all_products($limit,$offset) 
	{
		$this->db->limit($limit,$offset);
		$this->db->select("*"); 
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}

	function findProducts($keyword){
		$this->db->select("*"); 
		$this->db->from('products');
		$this->db->like('description', $keyword, 'both');
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

    function record_count(){
    	return $this->db->count_all('products');
    }

}
?>