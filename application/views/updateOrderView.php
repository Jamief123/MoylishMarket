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
			echo form_open_multipart('OrderController/updateOrder/'.$row->orderNumber);
			echo '';
			
			echo 'Order Number :';
			echo form_input('orderNumber', $row->orderNumber, "readonly class='form-group form-control formInputs'");

			echo 'Order Date :';
			echo form_input('orderDate', $row->orderDate, "readonly class='form-group form-control formInputs'");

			echo 'Required Date :';
			echo form_input('requiredDate', $row->requiredDate, "readonly class='form-group form-control formInputs'");

			echo 'Shipped Date :';
			echo form_input('shippedDate', $row->shippedDate, "class='form-group form-control formInputs'");

			echo 'Status:';
			echo form_input('status', $row->status, "class='form-group form-control formInputs'");

			echo 'Comments :';
			echo form_input('comments', $row->comments, "class='form-group form-control formInputs'");

			echo 'Customer Number :';
			echo form_input('customerNumber', $row->customerNumber, "readonly class='form-group form-control formInputs'");

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