<?php
$this->load->view('widgets/inner_banner');
?>
<!-- BEGIN Product Detail -->
<section class="contac-info CleaningServices attchedinhirit ProductDetail">
  <div class="container">
    <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-12">
    <div id="product__slider">
      <div class="col-xs-2 col-md-2 col-xs-12">
        <div class="slider-nav">
          <?php
            // debug($detail,1);
            if (array_filled($product_images)) {
              foreach ($product_images as $key => $value) {
          ?>
          <div class="slide">
            <div class="img_slide">
              <img src="<?php echo get_image($value['pi_image_path'], "thumb/".$value['pi_image_thumb']);?>" alt="" class="img-responsive">
              
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
      <div class="col-xs-10 col-md-10 col-xs-12">
        <div class="slider-for">
          <?php
            if (array_filled($product_images)) {
              foreach ($product_images as $key => $value) {
          ?>
          <div class="slide BigSliderimg">
            <img src="<?php echo get_image($value['pi_image_path'], $value['pi_image']);?>"  alt="" class="img-responsive">
          </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="DetailRight">
        <div class="detailContent">
        <small><?=$detail['product_name']?></small>
        <?php echo html_entity_decode($detail['product_overview']);?>
      <div class="price">
        <h3><?=price($detail['product_price'])?></h3>
        <h4><?=price($detail['product_old_price'])?></h4>
      </div>
      <div class="prod-li-qnt">
      <label>Quantity</label>
        <div class="input-group">
          <button class="btn_minus btn-number" data-field="quant[1]" data-type="minus" type="button">
            <span class="input-group-btn">-</span>
          </button>
          <input class="input-number" max="<?php echo $detail['product_stock'];?>" min="1" name="quant[1]" type="text" value="1" id="cart-qty"> 
          <button class="btn_plus btn-number" data-field="quant[1]" data-type="plus" type="button">
            <span class="input-group-btn">+</span>
          </button>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="addtocart pull-left">
        <a href="javascript:void(0)" data-productid="<?php echo $detail['product_id'];?>" class="purplebtn btn-cart">Add to cart</a>        
      </div>
      <div class="clearfix"></div>              
      </div>
      </div>
    </div>      
    </div>
  </div>
</section>
<section>
  <div class="OnSale">
    <div class="container">
      <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="tabsmain">
        <ul class="nav nav-tabs">
          <li  class="active"><a data-toggle="tab" href="#home" aria-expanded="false">Description</a></li>
          <li><a data-toggle="tab" href="#menu2" aria-expanded="true">Additional Info  </a></li>
        </ul>
        <div class="tab-content">
          <div id="home" class="tab-pane fade active in">
            <?php echo html_entity_decode($detail['product_detail']);?>
          </div>
          <div id="menu2" class="tab-pane fade">
            <?php echo html_entity_decode($detail['product_info']);?>
          </div>          
        </div>
        </div>       
      </div>        
      </div>
    </div>
  </div>
</section>
<!-- END Product Detail --> 


<script>

    $(".btn-wishlist").click(function(){
      var productid = $(this).attr('data-productid');
      var site_url = "<?=g('base_url')?>";
      $.ajax({
        type: "POST",
        url: site_url+"checkout/add_wishlist",
        data:  "product_id="+productid,
        dataType: "json",
        success: function(response)
        {
          $(".loading").hide();
          
          if(response.status == true){
              AdminToastr.success('Your item has been added into wishlist','Success');          

              $('.wishlist_span').html(response.wish_items);
              location.reload();
          }
          else{
              AdminToastr.error(response.txt,'Error');
            }
        },    
        beforeSend: function()
        {
          $(".loading").show();
        }
      });

      return false;
    });
    $(".btn-cart").click(function () {
        // is_login = '<?php echo $this->userid;?>';

        // if(is_login>0){
            //var wishlist = $(this).attr('data-wishlist');
            var productid = $(this).attr('data-productid');
            var qtyID = $('#cart-qty').val();
            // if (color == undefined){

            //   AdminToastr.error("Pleae select the color",'Error');

            // }
            // else{
              $.ajax({
                  type: "POST",
                  url: base_url + "checkout/add_cart",
                  // addone_array = define in detail page
                  data: "product_id=" + productid + "&product_qty=" + qtyID,
                  dataType: "json",
                  success: function (response) {
                      Loader.hide();

                      if (response.status == true) {
                          AdminToastr.success('Your item has been added into shopping cart.', 'Success');
                          $(".dol-color").html(response.total_items);
                          $("#item_count").html(response.total);
                          location.reload();
                          
                      }
                      else {
                          AdminToastr.error(response.msg, 'Error');
                      }
                  },
                  beforeSend: function () {
                      Loader.show();
                  }
              });
            // }
        // }
        // else{
        //     AdminToastr.error('Please Login to add item in cart', 'Error');
        // }
        return false;
    });
</script>