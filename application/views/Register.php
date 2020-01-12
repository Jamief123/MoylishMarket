<?php
    $this->load->view('header'); 
    $this->load->helper('url');
    $base = base_url() . index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="jumbotron">
      <h1 class="display-4">Glad to see you joining us!</h1>
      <p class="lead">Become a member of the Moylish Market to get access to amazing products.</p>
      <hr class="my-4">
      <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> -->
      <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
    
    <div class = "formInputs">

        <?php echo form_open_multipart('DefaultController/InsertCustomer');?>
            <div class="form-group">
                <input class="form-control" type="text" name="customerName" placeholder="Customer Name" required>
            </div>
            <div class="form-group">
                    <input class="form-control" type="text" name="contactFirstName" placeholder="Contact First Name" required>
            </div>
            <div class="form-group">
                    <input class="form-control" type="text" name="contactLastName" placeholder="Contact Last Name" required>
            </div>
            <div class="form-group">
                    <input class="form-control" type="text" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="addressLine1" placeholder="Address Line 1" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="addressLine2" placeholder="Address Line 2">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="country" placeholder="Country" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <?php
            echo form_submit('submitInsert', "Submit!", "class='btn btn-warning form-control'");

            echo form_close();
            echo validation_errors();
            ?>
        <a class="btn btn-primary btn-sm" href="<?php echo site_url('DefaultController/Index')?>">Go Back</a>
    </div>
    
</div>

<?php
$this->load->view('footer'); 
?>