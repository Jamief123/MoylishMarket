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
			<th>Order Date</th>
			<th>Required Date</th>
			<th>Shipped Date</th>
			<th>Status</th>
			<th>Comment</th>
			<!-- <th>Action</th> -->
		</thead>
		
	</tr>

	<?php foreach($order_info as $row){ ?>
	<tr>
		<td> 
			<?php echo $row->orderNumber ?> 
			<a class ="btn btn-warning btn-sm" href=" <?php echo site_url('OrderController/viewOrderDetails/'.$row->orderNumber); ?>">View Order</a>
		</td>
		<td> <?php echo $row->orderDate ?> </td>
		<td> <?php echo $row->requiredDate ?> </td>
		<td> <?php echo $row->shippedDate ?> </td>
		<td> <?php echo $row->status ?> </td>
		<td> 
			<form class="form-inline" action="<?php echo site_url('OrderController/editOrder') ?>" method="POST">
				<input type="text" class= "form-control" name="orderComment" value ="<?php echo $row->comments ?>">
				<input type="hidden" name="orderNumber" value="<?php echo $row->orderNumber ?>">
				<button type="submit" class="btn btn-warning btn-sm" value="Edit Order">Edit Order</button>
			</form>
			<form class="form-inline" action="<?php echo site_url('OrderController/cancelOrder') ?>" method="POST">
				<input type="hidden" name="orderNumber" value="<?php echo $row->orderNumber ?>">
				<button type="submit" class="btn btn-warning btn-sm" value="Edit Order">Cancel Order</button>
			</form>
		</td>
	 
			
	</tr>

	<?php } ?>
</table>

 <div class="pagination">
 	<?php echo $this->pagination->create_links(); ?>
 </div>

<?php
$this->load->view('footer'); 
?>