<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
<style type="text/css">
.panel-info {
    border-color: #000;
}
    .panel-info > .panel-heading {
    color: white;
    background-color: #000;
    border-color: #000;
}
.panel-heading {
    background: #006ebb!important;
    border: none;
    color: #eeeeee!important;
}
input[type="radio"], input[type="checkbox"] {
    margin: 4px 6px 0;
    line-height: normal;
}
.panel-body {
    background-color: #fff;
}
.panel {
    background: #fff;
}
</style>
<style type="text/css">
  #adp{
    text-align: center;
    font-size: 14px;
    font-weight: 600;
  }


   .box_content {
    text-align: justify;
    max-width: 600px;
    width: 100%;
    margin: 20px auto;
    padding: 15px;
    background: #fff;
    color: #595959;
    -webkit-border-bottom-right-radius: 4px;
    -webkit-border-bottom-left-radius: 4px;
    -moz-border-radius-bottomright: 4px;
    -moz-border-radius-bottomleft: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
}

ol {
    counter-reset: li;
    list-style: none;
    font: 15px 'trebuchet MS', 'lucida sans';
    padding: 0;
    margin-bottom: 4em;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    margin-left: -5px;
    margin-top: 0px;
    margin-bottom: 0px;
    width: 45%;
}

ol ol {
    margin: 0 0 0 2em;
}

.rounded-list a {
    position: relative;
    display: block;
    padding: .4em .4em .4em 2em;
    margin: .5em 0;
    background: #ddd;
    color: #444;
    text-decoration: none;
    -moz-border-radius: .3em;
    -webkit-border-radius: .3em;
    border-radius: .3em;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;
}

.rounded-list a:before {
    content: counter(li);
    counter-increment: li;
    position: absolute;
    left: -1.3em;
    top: 50%;
    margin-top: -1.3em;
    background: #ffc923;
    height: 39px;
    width: 39px;
    line-height: 31px;
    border: .3em solid #fff;
    text-align: center;
    font-weight: bold;
    -moz-border-radius: 2em;
    -webkit-border-radius: 2em;
    border-radius: 2em;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;
}

.rounded-list a:hover:before {
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
}

.rounded-list a:hover:before {
    background: #1da7e7;
    color: #fff;
}

/*checkbox css*/

.rdio{
    background: #03aad1;
    /* padding: 12px; */
    padding-left: 32px;
    padding-right: 15px;
    padding-bottom: 10px;
    padding-top: 16px;
    font-size: 18px;
    font-weight: 500;
    color: white;
    font-family: inherit;
}

/* end only demo styles */

</style>

<main>
    <section class="section-packages-head">
      <div class="container">
        <h1>Payment</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
            <li class="breadcrumb-item"><a href="<?=g('base_url')?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment</li>
          </ol>
        </nav>
      </div>
    </section>

<br>
<div class="container">
<!--  <h2>Select Payment Type</h2> -->
<form>
    <label class="radio-inline rdio">
      <input type="radio" name="" <?php if($this->uri->segment(1) == "propackages2"){ ?> checked <?php } ?> value="auto">
      <a href="<?=g('base_url')?>propackages2/payment?package=<?=$_GET['package']?>&oid=<?=$_GET['oid']?>" style="color: white;"> Credit Card (Stripe)</a>
    </label>


   <label class="radio-inline rdio">
    <input type="radio" name="" <?php if($this->uri->segment(1) == "propackages"){ ?> checked <?php } ?>  value="paypal">
    <a href="<?=g('base_url')?>propackages/payment?package=<?=$_GET['package']?>&oid=<?=$_GET['oid']?>" style="color: white;">PayPal </a>
  </label>
</form>
</div>

    <div class="container">
      <h2>Select Payment Method</h2>
      
      <form>
       
        <label class="radio-inline">
          <input type="radio" name="optradio2" checked value="auto">Paypal Auto Renewal
        </label>

         <label class="radio-inline">
          <input type="radio" name="optradio" value="paypal">Paypal (one time)
        </label>
        
      </form>

      <?php if($featuredStatus == 1){ 

        ?>
      <div class="checkbox">
          <label>
            <input type="checkbox" <?php if($checkedStatus == 1){ ?> checked <?php } ?> id="featureAd2" value="<?=$_GET['oid']?>" price="<?=$totalPrice?>">
            Select to place your ad in Featured Business section (£5.00) 
          </label>
        </div>
      <?php } ?>

        <!-- <div class="box_content"> -->
      <ol class="rounded-list">
      <li>
      <ol>
      <li><a href="javascrpit:void(0);" style="cursor: context-menu;">Package : <?=$packages['packages_name']?></a></li>
      <li><a href="javascrpit:void(0);" style="cursor: context-menu;">Price : £<?=$totalPrice?></a></li>
      <li><a href="javascrpit:void(0);" style="cursor: context-menu;">Package Expired : <?=$packages['packages_days']?> days</a></li>
      </ol>
      </li>
      </ol>
      <!-- </div> -->
      </div>

  

    <section class="cart-section">
    <div class="container wrapper">
            <div class="row cart-body" style="margin-top: 5em;margin-bottom: 5em;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!--CREDIT CART PAYMENT-->
                    <div id="payment-method-paypal"></div>
                    

                   <!--  <div id="paypal-button-container2"><h2 style="text-align: center;">Auto Renewal Paypal Coming Soon</h2></div> -->
                    <!--CREDIT CART PAYMENT END-->
                </div>
                <!-- </form> -->
            </div>
            <div class="row cart-footer">
            </div>
    </div>
        <div class="clearfix"></div>
</section>

  </main>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    $(document).ready(function(){

      $("#featureAd2").click(function(){

        var featurePrice = 5;
        var originalPrice = $(this).attr("price");
        var oid = $(this).val();

        if($(this).is(":checked")){

          // alert(oid);
          // return false;

          swal({
              title: "Are you sure?",
              text: "You want to select this feature onn",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                  url: "<?=g('base_url')?>Propackages/updateFeaturePriceOn",
                  data : {featurePrice:featurePrice,oid:oid,originalPrice:originalPrice},
                  type: "post",
                 dataType: "json",
                  success: function(response)
                  {

                  //response = JSON.parse(response);

                   //console.log(response);
                   //return false;

                  if(response.status == 1){

                    //var oid = response.oid;
                    //AdminToastr.info(response.data,"Info");
                     setTimeout(function(){
                    // window.location="<?=g('base_url')?>packages/payment?package="+pname+"&oid="+oid;
                        location.reload();
                     },1000);

                  }else{

                    AdminToastr.info(response.txt,"Info");
                  }
                  }
                  });

                swal("Featured business feature is onn!", {
                  icon: "success",
                });
              } else {
                swal("Your Feature is safe!");
              }
            });

        }else if($(this).is(":not(:checked)")){

          // alert("sasa");
          // return false;

          swal({
              title: "Are you sure?",
              text: "You want to select this feature off",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                  url: "<?=g('base_url')?>Propackages/updateFeaturePriceOf",
                  data : {featurePrice:featurePrice,oid:oid,originalPrice:originalPrice},
                  type: "post",
                  dataType: "json",
                  success: function(response)
                  {
                    //response = JSON.parse(response);

                  // console.log(response);
                  // return false;

                  if(response.status == 1){

                    setTimeout(function(){
                    // window.location="<?=g('base_url')?>packages/payment?package="+pname+"&oid="+oid;
                        location.reload();
                     },1000);

                  }else{

                    AdminToastr.info(response.txt,"Info");
                  }
                  }
                  });

                swal("Featured business feature is off!", {
                  icon: "success",
                });

              } else {

                swal("Your Feature is safe!");
              }
            });

          
        }else{}

      });







    $('input:radio[name="optradio2"]').click(function(){
      location.reload();
    });

    $('input:radio[name="optradio"]').click(function(){
      window.location="<?=g('base_url')?>packages/payment?package=<?=$packages['packages_name']?>&oid=<?=$_GET['oid']?>";
    });
});
    </script>

<script src="https://www.paypal.com/sdk/js?client-id=<?=PAYPAL_CLIENTID?>&vault=true"></script>

    <script>
paypal.Buttons({
    createSubscription: function(data, actions) {
        return actions.subscription.create({
          'plan_id': "<?=$planId?>"
      });
    },
      onApprove: function(data, actions) {

      console.log('You have successfully created subscription ' + data.subscriptionID);
      // console.log(data);
      // console.log(actions);
      // Capture the funds from the transaction
      // $('#paymentmethod').val('Paypal');
      // $('#payment-token').val( data.subscriptionID);
      var subId = data.subscriptionID;
      var data1 = {subid:subId,planId:"<?=$planId?>",access_token:"<?=$accesstoken?>",token_type:"<?=$token_type?>",subscription_id:"<?=$subscription_id?>",subscription_main_id:"<?=$subscription_main_id?>"};
      var url = "<?=l('PaypalSubscription/createSubscription')?>";
      response = AjaxRequest.fire(url, data1);  
      console.log(response);
      //return false;
      // console.log(response.response_url);    
      window.location = response.response_url;
    }
  }).render('#payment-method-paypal');

</script>
 