<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<table class="table table-striped table-bordered table-hover table-sm">
	<tr>
		<thead class="">
			<th>Order Number</th>
			<th>Product Code</th>
			<th>Quantity</th>
			<th>Individual Price</th>
			<!-- <th>Action</th> -->
		</thead>
		
	</tr>

	<?php foreach($order_info as $row){ ?>
	<tr>
		<td> <?php echo $row->orderNumber ?> </td>
		<td> <a href="<?php echo site_url('ProductController/viewProduct/'.$row->productCode);?>" ><?php echo $row->productCode ?> </a></td>
		<td> <?php echo $row->quantityOrdered ?> </td>
		<td> <?php echo $row->priceEach ?> </td>
	</tr>

	<?php } ?>
</table>

<?php
$this->load->view('footer'); 
?>