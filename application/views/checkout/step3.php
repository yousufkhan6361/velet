<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Breadcrumbs -->
<?php
// $merchant_data = $this->model_merchant->find_by_pk(1);
//$data['breadcrumb_title'] = 'Payment';
//$this->load->view('widgets/breadcrumb',$data);
?>

<section class="checkout-main check_laststep">

    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <h1 class="text-center"><b>Amount: </b><?=price($amount)?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <h2 class="text-center">Merchant Coming Soon</h2>
        </div>
      </div>
      <!-- <div class="row mt-50">
        <div class="col-md-12 col-sm-12 col-xs-12 radiobtn">
<?php if ($merchant_data['merchant_paypal']==1): ?>
          <input type="radio" name="select_merchant" class="select_merchant" id="paypalm" value="1">
          <label for="paypalm">Paypal</label>
<?php endif ?>
<?php if ($merchant_data['merchant_stripe']==1): ?>
          <input type="radio" name="select_merchant" class="select_merchant" id="stripem" value="2">
          <label for="stripem">Stripe</label>
<?php endif ?>
                    
        </div>
      </div> -->

      <!-- <div class="row merchant_stripe dn">
        <div class="col-md-12 col-sm-12 col-xs-12">
<?php if ($merchant_data['merchant_stripe']==1): ?>
         <?php $this->load->view('widgets/stripe_pro'); ?>
<?php endif ?>
</div>
      </div> -->

      <!-- <div class="row merchant_paypal dn">
        <div class="col-md-12 col-sm-12 col-xs-12">
<?php if ($merchant_data['merchant_paypal']==1): ?>
          <?php $this->load->view('widgets/paypal_pro'); ?>
<?php endif ?>       
        </div>
      </div> -->

    </div>

</section>



<script type="text/javascript">
  $(document).ready(function(){
    $(".select_merchant").click(function(){
      var merchant_val = $(this).val();
      if (merchant_val == 1)
      {
        $(".merchant_paypal").show();
        $(".merchant_stripe").hide();
      }
      else if (merchant_val == 2)
      {
        $(".merchant_paypal").hide();
        $(".merchant_stripe").show();
      }

    });
  });
</script>
