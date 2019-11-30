<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>


<?php 	foreach ($view_data as $row) { ?>
		
	<img src="<?php echo $img_base.'products/full/'.$row->photo; ?>" class="img-rounded" alt="<?php echo $row->description ?>">

<?php	}
	$this->load->view('footer'); 
?>