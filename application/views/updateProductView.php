<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<br>
<div class="jumbotron">
	<h1 class="main"> Update Product </h1>
	<?php 
		foreach ($edit_data as $row) { 
			echo form_open_multipart('ProductController/updateProduct/'.$row->produceCode);
			echo '';
			
			echo 'Produce Code :';
			echo form_input('produceCode', $row->produceCode, "readonly class='form-group form-control formInputs'");

			echo 'Description :';
			echo form_input('description', $row->description, "class='form-group form-control formInputs'");

			echo 'Product Line :';
			echo form_input('productLine', $row->productLine, "class='form-group form-control formInputs'");

			echo 'Supplier :';
			echo form_input('supplier', $row->supplier, "class='form-group form-control formInputs'");

			echo 'Quantity In Stock:';
			echo form_input('quantityInStock', $row->quantityInStock, "class='form-group form-control formInputs'");

			echo 'Bulk Buy Price :';
			echo form_input('bulkBuyPrice', $row->bulkBuyPrice, "class='form-group form-control formInputs'");

			echo 'Bulk Sale Price :';
			echo form_input('bulkSalePrice', $row->bulkSalePrice, "class='form-group form-control formInputs'");

			echo 'Discontinued (1/0) :';
			echo form_input('discontinued', $row->discontinued, "class='form-group form-control formInputs'");

			echo 'Select File for Upload :';
			echo form_upload('userfile','', "class='form-group form-control formInputs'");

			echo '';
			echo form_submit('submitUpdate', "Submit!", "class='form-group form-control formInputs btn btn-warning'");
			echo form_close();
			echo validation_errors();
		}
	?>
</div>
<?php
	$this->load->view('footer'); 
?>