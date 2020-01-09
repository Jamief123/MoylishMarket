<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>


<?php echo form_open('ProductController/updateBasket');  ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

<tr>
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

    <tr>
        <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
        <td>
            <?php echo $items['name']; ?>

            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                <p>
                    <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                            <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                    <?php endforeach; ?>
                </p>

            <?php endif; ?>

        </td>
        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
        <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
    </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
    <td colspan="2"> </td>
    <td class="right"><strong>Total</strong></td>
    <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

<p><?php echo form_submit('', 'Update Basket',"class='btn btn-warning'"); ?></p>

<form method= "POST" name="checkout" action="<?php echo site_url('ProductController/checkout');?>">
    <button class="btn btn-warning" type="submit" name="submitBasketAdd"><i class="fa fa-shopping-basket"></i> Checkout</button>
</form>

<?php
	$this->load->view('footer'); 
?>
