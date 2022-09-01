<?php
  $this->load->view("widgets/inner_banner");
?>
<section class="checkout-sec AboutUsSection">
      <div class="MiddleSec">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="checkout-tab-main">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                  <div class="form-sec-checkout">
                    <div class="form-tab">
                      <form id="submitStep2" method="post">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="checkout-heading">
                            <h3>Billing Address</h3>
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_firstname]" value="<?php echo $userdata['signup_firstname'];?>" placeholder="Your First Name*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_lastname]" value="<?php echo $userdata['signup_lastname'];?>"  placeholder="Last name*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_company]" value="<?php echo $userdata['signup_company'];?>"  placeholder="Company Name*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_email]" value="<?php echo $userdata['signup_email'];?>"  placeholder="Email Id*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_phone]" value="<?php echo $userdata['signup_contact'];?>" placeholder="Phone Number*" >
                          </div>
                          <div class="form-group">
                            <select name="order[order_country]" class="form-control" >

                              <?php

                              foreach ($country as $key=>$value):

                              $name = $value['country'];

                              ?>

                              <option value="<?php echo $name;?>" <?php echo ($name=='USA')?'selected':''?> ><?php echo $name;?></option>

                              <?php endforeach;?>

                              </select>
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_state]" value="<?php echo $userdata['order_state'];?>" placeholder="State*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_address1]" value="<?php echo $userdata['signup_address'];?>" placeholder="Address*">
                          </div>
                          <div class="form-group">
                            <input class="form-control" name="order[order_city]" value="<?php echo $userdata['signup_city'];?>" placeholder="Town / City*" type="text" >
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="order[order_zip]" value="<?php echo $userdata['signup_zip'];?>" placeholder="Postcode / Zipcode*">
                          </div>
                          <div class="form-group">
                            <textarea class="form-control hight230" placeholder="Order Note*" name="order[order_message]"></textarea>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="checkoutHead">
                    <h3>your order</h3>
                  </div>
                  <div class="checkoutSec">
                    <div class="checkoutBox">
                      <div class="checkoutBody bgnone">
                        <ul class="list-unstyled">
                          <li>Products<span class="pull-right">Totals</span></li>
                        </ul>
                      </div>                    
                      <div class="chk-one">
                        <div class="checkoutBody">
                          <ul class="list-unstyled">
                            <?php
                            if (array_filled($cart_data)) {
                                foreach ($cart_data as $key => $value):
                                    $options = $value['options'];
                            ?>
                            <li><?=$value['name']?> X-<?=$value['qty']?><span class="pull-right purplecolor"><?php echo price($value['price'] * $value['qty']);?></span></li>
                            <?php
                              endforeach;
                              }
                            ?>
                          </ul>
                        </div>
                        <div class="checkoutFoot">
                          <div class="web-btn"> <a href="javascript:void(0)" id="btn-order">PLACE ORDER</a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>




<script type="text/javascript">



    $(document).ready(function () {

        

        $(".state_drop").change(function(){

           var get_tax = $(".state_drop :selected").attr("data-attr");

           if(get_tax == "undefined"){

               AdminToastr.error('Select correct state','Error');

                return false;

           }

           else{

               $(".add_tax").html('Tax<span> $'+get_tax+'</span>');

               

               var str = $(".total_and_shipping").val();

               var coupon_dis = $(".coupon_dis").val();

               if(coupon_dis != "")

               {

                var final = (parseFloat(str) + parseFloat(get_tax) - parseFloat(coupon_dis));    

               }

               else{

                   var final = parseFloat(str) + parseFloat(get_tax);

               }

               

               $(".set_total").text("$"+final.toFixed(2));

           }

        });

        

        $("#btn-order").click(function (e) {

          // AdminToastr.error("Coming Soon",'Error');
          // return 0;

            // var pass = $('input[name="order[order_password]"]').val();

            // var cpass = $('input[name="order_password_confirm"]').val();

            // var user_id = '<?php echo $this->userid?>';



      // if(pass.length<6 || cpass.length<6 ){

      //     AdminToastr.error('Minimum Password length is 6 characters','Error');

      // }

    //   if(user_id < 1){

    //     if(pass!=cpass){

    //         AdminToastr.error('Password and Re-enter Password fields are not matched','Error');

    //     }

    // }else{





            //var user_id = '<?php echo $this->userid?>';

            // if(user_id < 1){

            //     AdminToastr.error('Please login to proceed','Error');

            //     return false;

            // }

            // else { 

                e.preventDefault();

                Loader.show();

                setTimeout(function () {

                    // Prevent form submit

                    e.preventDefault();

                    var obj = $("#submitStep2");

                    // Get form data

                    var data = obj.serialize();

                    

                    // Get post url

                    var url = "<?=g('base_url');?>checkout/save-order";

                    // Submit action

                    //var response = AjaxRequest.fire(url, data);

                    var response = AjaxRequest.formrequest(url, data) ;

                    if(response.status===1){

                    //location.reload();

                    // alert(response.url);

                    window.location = response.url;

                    $('#submitStep2').trigger("reset");

                }
                else{
                  Loader.hide();
                  AdminToastr.error(response.txt,'Error');
                }

                    // if(response.status){

                    //     // location.reload();

                    //     // window.location = response.url;

                    //     // $('#submitStep2').trigger("reset");

                    //     window.location  = response.url;

                    // }

                    // Add return

                    return false;

                },1000);



                return false;

            // }

        });

    });

</script>