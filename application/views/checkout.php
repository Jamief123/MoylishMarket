<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo $items['name']; ?>

<?php endforeach; ?>


<?php
	$this->load->view('footer'); 
?>
