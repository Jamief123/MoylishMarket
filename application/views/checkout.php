<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('checkoutHeader'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="<?php echo site_url('OrderController/handleCheckout'); ?>" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="O'Connell Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="Dublin">

            <div class="row">
              <div class="col-50">
                <label for="county">County</label>
                <input type="text" id="county" name="county" placeholder="Dublin">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
            <div class="row">
              <div class="col-100">
                <label for="comments">Extra Comments</label>
                <input type="text" id="comments" name="comments" placeholder="Place outside door">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Confirm Payment" class="btn btn-warning form-group form-control">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo count($this->cart->contents()); ?></b></span></h4>

      <?php foreach ($this->cart->contents() as $items): ?>
      	<p><a href="#"><?php echo $items['name']; ?></a> <span class="price">€<?php echo $items['subtotal']; ?></span></p>
      <?php endforeach; ?>
      <hr>
      <p>Total <span class="price" style="color:black"><b>€<?php echo $this->cart->format_number($this->cart->total()); ?></b></span></p>
    </div>
  </div>
</div>



<?php
	$this->load->view('footer'); 
?>
