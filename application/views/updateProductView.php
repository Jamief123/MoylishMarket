<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<br>
<h1 class="main"> Update Product </h1>
<?php 
	foreach ($edit_data as $row) { 
		echo form_open_multipart('ProductController/updateProduct/'.$row->produceCode);
		echo '</br></br>';
		
		echo 'Produce Code :';
		echo form_input('produceCode', $row->produceCode, 'readonly');

		echo '</br></br>Description :';
		echo form_input('description', $row->description);

		echo '</br></br>Product Line :';
		echo form_input('productLine', $row->productLine);

		echo '</br></br>Supplier :';
		echo form_input('supplier', $row->supplier);

		echo '</br></br>Quantity In Stock:';
		echo form_input('quantityInStock', $row->quantityInStock);

		echo '</br></br>Bulk Buy Price :';
		echo form_input('bulkBuyPrice', $row->bulkBuyPrice);

		echo '</br></br>Bulk Sale Price :';
		echo form_input('bulkSalePrice', $row->bulkSalePrice);

		echo '</br></br>Discontinued (1/0) :';
		echo form_input('discontinued', $row->discontinued);

		echo '</br></br>Select File for Upload :';
		echo form_upload('userfile');

		echo '</br></br>';
		echo form_submit('submitUpdate', "Submit!");
		echo form_close();
		echo validation_errors();
	}
?>

<?php
	$this->load->view('footer'); 
?>