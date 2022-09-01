<?php
  $this->load->view("widgets/inner_banner");
?>
<section>
  <div class="MiddleSec">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="cartmain">
            <div class="carttbale">
            <table class="table">
              <thead>
                <tr>
                  <th>preview</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (array_filled($cart_data)) {
                      foreach ($cart_data as $key => $value):
                        $options = $value['options'];
                ?>
                <tr>
                  <td>
                    <div class="cartimg">
                      <a href="<?php echo $options['product_slug'];?>">
                        <img src="<?php echo $options['product_img'];?>" class="img-responsive">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="prodecttext">
                      <a href="<?php echo $options['product_slug'];?>">
                        <span><?php echo $value['name'];?></span>
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="price">
                      <small><?php echo price($value['price']);?></small>
                    </div>
                  </td>
                  <td>
                    <div class="Quantity">
                    <div class="qty-changer">
                    <input class="qty-input form-group" type="number" max="<?=(!empty($options['product_stock']) ? $options['product_stock'] : 10)?>" min="1" value="<?php echo $value['qty']?>" id="qty-<?php echo $key;?>" name="quantity<?php echo $key;?>"/><br>
                    <a href="javascript:void(0)" class="update_qty update" data-key="<?php echo $key?>" data-product_id="<?php echo $value['rowid']?>">Update Cart</a>
                    </div>
                    </div>
                  </td>
                  <td>
                    <div class="TotalPrice">
                      <span><?php echo price($value['price'] * $value['qty']);?></span>
                    </div>
                  </td>
                  <td>
                    <div class="closebtn">
                      <button class="removeproduct" data-row-id="<?php echo $value['rowid']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
                <?php endforeach;?>
                <?php }
                else{?>
                    <tr>
                        <td colspan="6">
                            <h3 class="text-center">Cart is Empty</h3>
                        </td>
                    </tr>
                <?php }
                ?>     
              </tbody>
            </table>                                 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-8">
          <?php
          if (array_filled($cart_data)) {?>
          <div class="checkoutSec mtop40">
            <div class="checkoutBox">
              <div class="chk-one">
                <div class="totlalhead">
                  <span>Cart Total</span>
                </div>
                <div class="checkoutBody">
                  <ul class="list-unstyled">
                    <li>Sub Total<span class="pull-right"><?=price($this->cart->total())?></span></li>
                    <li>Total<span class="pull-right"><?=price($this->cart->total())?></span></li>
                  </ul>
                </div>
                <div class="checkoutFoot">
                  <div class="web-btn"> <a href="<?=g('base_url')?>checkout/step2" class="proceed_btn">Proceed To Checkout</a> </div>
                </div>
              </div>
            </div>
          </div>
          <?php }?>              
        </div>
      </div>
    </div>
  </div>
</section>





<!-- cartSec start -->



<!-- cartSec End -->



<script>
    // Update Cart Start
        $('#btnmovestep2').on('click', function () {
            $(".form_shipping").submit();
        }); 
        
    
    $('.update_qty').on('click', function () {
        var obj_qty = $(this);

        Loader.show();
        setTimeout(function () {
            // Get data
            var key = obj_qty.attr('data-key'),
                product_id = obj_qty.attr('data-product_id'),
                qty = $("#qty-"  + key).val(),
                max = $("#qty-"  + key).attr("max"),
                data = {"id": product_id, "qty": qty},
                url = base_url + "checkout/update_qty_cart";

            //console.log(data);

            if (qty == 0) {
                Loader.hide();
                AdminToastr.error("Quantity must be greater to 0", 'Error');
            }
            else if (parseInt(qty) > parseInt(max)) {
                Loader.hide();
                $("#qty-"  + key).val(1);
                AdminToastr.error("Quantity must be less than 10", 'Error');
            }
            else {
                // Submit action
                var response = AjaxRequest.fire(url, data);
                // Register success
                if (response.status == true) {
                    //AdminToastr.success(response.txt,'Success');

                    window.location = "checkout";
                }
                else if (response.status == 2) {
                    AdminToastr.error("Quantity is not available", 'Error');
                }
            }
            return false;
        },1000);

    });
    // Update Cart End

    // Delete From Cart Start
    $('.removeproduct').on('click', function () {
        // Get data
        var row_id = $(this).attr('data-row-id');
        url = base_url + "checkout/delete_item/" + row_id;

        if (confirm('Are you sure you want to delete this Product from cart')) {
            //  redirect to delete
            location.href = url;
        }
        return false;
    });
    // Delete From Cart End
</script>

<script>
        // new WOW().init();
        $('button[data-type="plus"]').click(function(){
          var input = $(this).parent().prev();
          var val = $(input).val();
          console.log(val++);
          val = parseInt(val,10);
          val = val++;
          $(input).val(val);
   });

        $('button[data-type="minus"]').click(function(){
          var input = $(this).parent().prev();
          var val = $(input).val();
          console.log(val--);
          val = parseInt(val,10);
          val = val--;
          $(input).val(val);
   });
   
  </script>
  <script>

// couponcode

$( "body" ).on( "change", ".shipping_dropd", function() {
    var val = $(".shipping_dropd :selected").val();
    var price = $(".shipping_dropd :selected").attr("data-attr");
    if(val != "")
    {
        // console.log(val);
        // console.log(price);
        $(".shipping_price").text("$"+parseFloat(price).toFixed(2));
        $(".shipping_price_hidden").val(parseFloat(price).toFixed(2));
        var fid = $(".final_total").text();
        var final_total = parseFloat(fid.substring(1, fid.length));
        // console.log(final_total);
        var cal_finall = parseFloat(final_total)+parseFloat(price);
        $(".final_total").text("$"+parseFloat(cal_finall).toFixed(2));
        $(".final_total_hidden").val(parseFloat(cal_finall).toFixed(2));
        
        $.ajax({
            type: "POST",
            url: base_url + "checkout/set_shipping",
            data: "value=" + val + "&price=" + price,
            dataType: "json",
            success: function (msg) {
                if (msg.status == 1) {
                    $(".proceed_btn").show();
                }
                else {
                    $(".proceed_btn").hide();
                }
            },
            beforeSend: function () {
                $(".proceed_btn").hide();
            }
        });
    }
    else
    {
        $(".proceed_btn").hide();
    }
});
$("#submitfedex").click(function () {
    
    var ounces_z = parseInt($(".ounces_z").val());
    var weight_z = parseInt($(".weight_z").val());
    var destination_z = parseInt($(".destination_z").val());
    
    if(destination_z <= 0 ||  weight_z <= 0 || ounces_z <= 0)
    {
        AdminToastr.error("Values must be positive", 'Error');
    }
    else if(weight_z > 70)
    {
        AdminToastr.error("weight should be less than 70 LBS", 'Error');
    }
    else{
    $(".show_dropdown_shipping").empty();
    	var empty = 0;
    	$('input[type=number]').each(function(){
	       if (this.value == "") {
	           empty++;
	           $("#error").show('slow');
	       }
	    });

	    if (empty == 0)
	    {
	        //var data = $("#upsshiptype").find('input, select').serialize();
	        var data = $("#shipping-zip-form-fedex").serialize();

	        $.ajax({

	            type: "POST",

	            url: base_url + "checkout/get_usps",

	            data: data,

	            dataType: "json",

	            success: function (msg) {
	               // console.log(msg);
	               // return 0;
	                Loader.hide();

	                if (msg.status == 1) {
	                   //console.log(msg);
	                  // return 0;
	                  $(".show_dropdown_shipping").html(msg.txt);
	                    // Update price in total field
	                    //$("input[name=subtotal]").val(price_with_shipment);
	                    AdminToastr.success("Success", 'Success');

	                    
	                }
	                else {
	                    AdminToastr.error(msg.txt, 'Error');
	                    $(".proceed_btn").hide();
	                }
	            },
	            beforeSend: function () {
	                Loader.show();
	            }
	        });
	    }
	    else{
            AdminToastr.error("Please fill all the details", 'Error');	    	
	    }
    }
});


jQuery(".couponcode").click(function(){


var data = jQuery("#couponform").serialize();

var url = "<?=g('base_url')?>checkout/discount";

response = AjaxRequest.formrequest(url, data) ;


if(response.status == 1){


    AdminToastr.success(response.txt,'Success');


    setTimeout(function() {
                  location.reload();
                }, 2000);
    $("input[type=text]").val("");
 
     // $('.discountamount').html(parseFloat(response.couponamount)+ '%');
     // $('.gtotal').html('$'+parseFloat(response.coupon_total).toFixed(2));
     $("#coupon_discount").html(response.couponamount);
     $("#orderTotal").html(response.coupon_total);


    
    $.ajax({
    type: "POST",
    url: "<?=g('base_url')?>checkout/get_basket",
    data:  "",
    dataType: "json",

    success: function(msg)
    {      
      console.log(msg);
      
      
      $("#item_count").html(msg.total);  



      var cartqty = msg.total_items;
      var cartqty = cartqty.replace("Item(s)", "");

      if(cartqty > 19)
      {

        var discount =   parseInt(response.discount) + 10;
         
      }
      else
      {
        var discount = response.discount;
      }

      var str = msg.total;
      var res222 = str.substr(1, 10);
      

      // res222 = <?=$this->cart->total()?> + 8 ;
      res222 = res222 - ((res222 *  discount) / 100);


      $('.totalcharges').html('$'+ res222);    


    },
    beforeSend: function()
    {
      //$("#loading-sp").show();
    }
    });


}
else{
AdminToastr.error(response.txt,'Error'); 
}
return false;
});

</script>