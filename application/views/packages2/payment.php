<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style type="text/css">
.custom-pro{
    transition: all 0.7s ease-in-out;
position: relative;
text-align: center;
min-width: 500px;
max-width: 750px;
font-size: 18px;
display: block;
white-space: nowrap;
margin: 0;
background: 0;
border: 0;
font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
text-transform: none;
font-weight: 500;
R -webkit-font-smoothing: antialiased;
font-smoothing: antialiased;
z-index: 0;
font-size: 0;
width: 100%;
box-sizing: border-box;
background: #ffc439;
color: #111;
font-size: 18px;
}
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

    <div class="container">
      <h2>Select Payment Method</h2>
      
      <form>
         <label class="radio-inline">
          <input type="radio" name="optradio2" value="auto">Debit / Credit (Auto Renewal)
        </label>
        
        <label class="radio-inline">
          <input type="radio" name="optradio" checked value="paypal">Debit / Credit (One Time)
        </label>
      </form>

      <?php if($featuredStatus == 1){ 

        ?>
      <div class="checkbox">
          <label>
            <input type="checkbox" <?php if($checkedStatus == 1){ ?> checked <?php } ?> id="featureAd" value="<?=$_GET['oid']?>" price="<?=$totalPrice?>">
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

      <?{ ?>

         <li>
        <input style="" class="form-control" id="couponVal" type="text" name="" placeholder="Add Coupon" value="">
        <input type="hidden" id="oid" name="oid" value="<?=$_GET['oid']?>">
        <!-- <small style="color: #8d908f;">Get Discount</small> -->
      </li>

      <li style="padding-top: 10px;">
        <button class="btn btn-primary couponBtn" type="button">Add Coupon</button>
      </li>


      <?php } ?>
      
      </ol>
      </li>
      </ol>
      <!-- </div> -->
      </div>

      <?php

      // // if($this->session->has_userdata('couponSession')){
      //    $couponSession = $this->session->userdata('couponSession');
      //    debug($couponSession);
      // // }

      ?>

      <section>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <form id="payment-form" action="javascript:void(0)">
                <h4>Add Card Details</h4>
                <!-- <input type="hidden" name="product_id" value="<?=$product['product_id']?>"/> -->
               <input type="hidden" name="packages_id" class="packages_id" value="<?=$packageid?>"/> 
                <input type="hidden" name="oid" class="order_id" value="<?=$_GET['oid']?>"/>
                <div id="card-element" class="form-control">
                </div>
                <div id="card-errors" role="alert"></div><br/>
                <div class="btn btn-primary pay" style="width:100%;">Pay</div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <br><br>

    <!-- <section class="cart-section">
    <div class="container wrapper">
            <div class="row cart-body" style="margin-top: 5em;margin-bottom: 5em;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   
                    <?if($totalPrice == 0.00)
                    {?>
                        <form id="proform" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="oid" name="oid" value="<?=$_GET['oid']?>">
                            
                                <button id="pro" class="btn btn-primary custom-pro" type="submit">Proceed</button>
                                
                        </form>
                    <?}
                    
                    else{?>
                        <div id="paypal-button-container"></div>
                    <?}?>
                  
                </div>
               
            </div>
            <div class="row cart-footer">
            </div>
    </div>
        <div class="clearfix"></div>
</section> -->

  </main>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>

  var userid = '<?=$this->userid?>';
  // var stripe = Stripe('pk_test_hWqb9XMOfZFuscYRUOHPNIyg');
  var stripe = Stripe('<?=g("db.admin.stripe_publishable_key")?>');

  var elements = stripe.elements();

  var style = {
  base: {
    // 'lineHeight': '1.35',
    // 'fontSize': '1.11rem',
    'color': '#495057',
    'fontFamily': 'apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',
    'padding': '8px 12px'
    }
  };
  var card = elements.create("card", { style: style });
  card.mount("#card-element");

  card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');

    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  $('.pay').click(function(){
    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Inform the customer that there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {

        // Send the token to your server.
        stripeTokenHandler(result.token);

      }
    });
  });

  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    // form.submit();
    var data = $('#payment-form').serialize();
    var url = '<?=g('base_url')?>'+'packages2/package_payment';
    $.ajax({
                url: url,
                type: "POST",
                // headers: {"X-My-Custom-Header": "POST"},
                data: data,
                // async: false,  // Has to be false to be able to return response
                dataType: "json",  // Has to be false to be able to return response
                success: function(response) {
                   if(response.status)
                    {
                      // console.log(res);
                      // return false;
                      $(".pay").removeAttr("disabled");
                      AdminToastr.success(response.txt);

                      setInterval(function(){
                          window.location="<?=g('base_url')?>account/orderhistory"
                        },3000);
                      }
                    else {
                      $(".pay").removeAttr("disabled");
                      // AdminToastr.error(res.txt);
                    }
                }
            });
    // var res = AjaxRequest.formrequest(url, data);
    // if(res.status)
    // {
    //   AdminToastr.success(res.txt);
    //   setInterval(function(){
    //     window.location.reload();
    //   }, 2000);
    // }
    // else {
    //   AdminToastr.error(res.txt);
    // }
  }

  $('.alert').click(function(){
    AdminToastr.error("Please login to buy this product!");
  })

  $('.add').click(function(){
    AdminToastr.error("Feature unavailable!");
  })
</script>




  <script>
    $(document).ready(function(){
        
        $("#pro").click(function(){
            // window.location.href='<?=g('base_url')?>packages/payment?packages=<?=$packages['packages_name']?>&oid=<?=$_GET['oid']?>';
            
          $.ajax({
            // window.location.href='<?=g('base_url')?>checkout/notify_without_payment';
            
            // alert("The paragraph was clicked.");
            url: "<?=g('base_url')?>checkout/notify_without_payment",
                  data : $('#proform').serialize(),
                  type: "post",
                  success: function(response)
                  {
                  response = JSON.parse(response);
                  if(response.status == 1){

                    //var oid = response.oid;
                    AdminToastr.success(response.txt,"Success");
                     setTimeout(function(){
                    window.location="<?=g('base_url')?>checkout/success?oid=<?=$custom?>&code=<?=md5($custom)?>";
                        // location.reload();
                     },2000);

                  }else{

                    AdminToastr.info(response.txt,"Failed");
                  }
                  }
          });
            
// alert("The paragraph was clicked.");
                    
                  });
 
        
    $(".couponBtn").click(function(){

      var coupon = $("#couponVal").val();
      var oid = $("#oid").val();
      var price = <?=$totalPrice?>;
      var packageId = <?=$packages['packages_id']?>;
      var userId = <?=$this->userid?>;

      if( coupon == ""){

        AdminToastr.error("Coupon field is empty","Error");

      }else{

        $.ajax({
                  url: "<?=g('base_url')?>packages/checkCoupon",
                  data : {coupon:coupon,price:price,packageId:packageId,userId:userId,oid:oid},
                  type: "post",
                  success: function(response)
                  {
                  response = JSON.parse(response);

                   //console.log(response);
                  // return false;

                  if(response.status == 1){

                    //var oid = response.oid;
                    AdminToastr.success(response.txt,"Success");
                     setTimeout(function(){
                    // window.location="<?=g('base_url')?>packages/payment?package="+pname+"&oid="+oid;
                        location.reload();
                     },2000);

                  }else{

                    AdminToastr.info(response.txt,"Info");
                  }
                  }
                  });
      }


    });


      $("#featureAd").click(function(){

        var featurePrice = 5;
        var originalPrice = $(this).attr("price");
        var oid = $(this).val();

        if($(this).is(":checked")){

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
                  url: "<?=g('base_url')?>packages/updateFeaturePriceOn",
                  data : {featurePrice:featurePrice,oid:oid,originalPrice:originalPrice},
                  type: "post",
                  success: function(response)
                  {
                  response = JSON.parse(response);

                  // console.log(response);
                  // return false;

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
                  url: "<?=g('base_url')?>packages/updateFeaturePriceOf",
                  data : {featurePrice:featurePrice,oid:oid,originalPrice:originalPrice},
                  type: "post",
                  success: function(response)
                  {
                  response = JSON.parse(response);

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

    //   $("#paypal-button-container").hide();
    //   $("#paypal-button-container2").hide();

    //   $('input:radio[name="optradio"]').change(
    //   function(){
    //       if ($(this).is(':checked') && $(this).val() == 'paypal') {
    //           $("#paypal-button-container2").hide();
    //           $("#paypal-button-container").fadeIn();
    //       }else{

    //         $("#paypal-button-container").hide();
    //         $("#paypal-button-container2").fadeIn();
    //       }
    // });

    $('input:radio[name="optradio"]').click(function(){

      location.reload();
    });

    $('input:radio[name="optradio2"]').click(function(){

      window.location="<?=g('base_url')?>propackages2/payment?package=<?=$packages['packages_name']?>&oid=<?=$_GET['oid']?>";
    });


      // var getAmount = $("#getAmount").val();
      // var getAmount = '<?=$totalPrice?>';
      // var getcurrency = 'GBP';
      
      //   paypal.Button.render({
      //       env: '<?=PAYPAL_ENVIRONMENT?>', // sandbox | production
      //       style: {
      //       label: 'checkout',
      //       size: 'responsive', // small | medium | large | responsive
      //       shape: 'rect',  // pill | rect
      //       color: 'gold'    // gold | blue | silver | black
      //   },
      //       client: {
      //              // sandbox:  
      //           <?=PAYPAL_ENVIRONMENT?>: '<?=PAYPAL_CLIENTID?>'
      //       },
      //       // Show the buyer a 'Pay Now' button in the checkout flow
      //       commit: true,
      //       // payment() is called when the button is clicked
      //       payment: function(data, actions) {
      //           // Make a call to the REST api to create the payment
      //           return actions.payment.create({
      //               payment: {
      //                   transactions: [
      //                       {
      //                           amount: { total: getAmount, currency: getcurrency } 
      //                       }
      //                   ]
      //               }
      //           });
      //       },
      //       // onAuthorize() is called when the buyer approves the payment
      //       onAuthorize: function(data, actions) {
      //           // Make a call to the REST api to execute the payment
      //           return actions.payment.execute().then(function() {
      //               //window.alert('Payment Complete!');
      //               AdminToastr.success('Thank you! your payment has been made.','Payment Success');
      //               var EXECUTE_URL = '<?=$notify?>';
      //               var params = {
      //                payment_status:'Completed',
      //                custom:'<?=$custom?>',
      //                paymentID: data.paymentID,
      //                payerID: data.payerID
      //               };
      //               if(paypal.request.post(EXECUTE_URL, params)){
      //                if(params.payment_status=='Completed'){
      //                 setInterval(function(){ 
      //                    window.location = '<?=g('base_url')?>checkout/success?oid=<?=$custom?>&code=<?=md5($custom)?>'
      //                 }, 3000); 
      //                } else {
      //                 AdminToastr.success('Error','Payment Failed');
      //                }
      //               }
      //           }).catch(function (error) {
      //             AdminToastr.success(error,'Payment Failed');
      //           });
      //       }
      //   }, '#paypal-button-container');
});
    </script>
 