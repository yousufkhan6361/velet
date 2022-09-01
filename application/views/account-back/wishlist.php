<? $this->load->view("account/header"); ?>
<!--login-banner-->

<div class="signup">

<div class="container" id='goTo'>
        <ul class="breadcrumb">
            <li><a href="<?=g('base_url')?>">Home</a></li>
            <li class="active"><?=$title?></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <? $this->load->view("account/menu"); ?>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            
            <div class="content-page">
              
            	<div class="row">
                <div class="portlet grey-cascade box">
                          <div class="portlet-body">
                            <div class="table-responsive">
                              <?php
                              if(count($wishlist) > 0){
                              ?>
                              <table class="table table-hover table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              foreach ($wishlist as $key => $value) {    
                              $productId = $this->model_product->get_product_by_id($value['wishlist_product_id']);
                              ?>
                              <tr>
                                <td>
                                  <a href="<?=g('base_url')?>product-detail/<?=$productId['product_slug']?>">
                                  <?=$productId['product_name']?> </a>
                                </td>
                                <td id="cart_image_container_<?=$value['product_id']?>">
                                  <img width="90" height="90" src="<?=Links::img($productId['pi_image_path'],$productId['pi_image'])?>">
                                </td>
                                <td>
                                  <?=price($productId['product_price'])?>   
                                </td>
                                
                                <td>
                                  <input type="hidden" name="qty" id="qty_<?=$productId['product_id']?>" value="1"> 
                                  <a href="javascript:void(0)" data-wishlist="1" data-productid="<?=$productId['product_id']?>" data-qty="1" class="btn-cart" >
                                  Add to Cart 
                                  </a>
                                </td>
                               
                                
                              </tr>
                              <?php
                              }
                              ?>
                              </tbody>
                              </table>
                              <?php
                              }
                              else{
                                echo "0 item(s) found";
                              }
                              ?>
                            </div>
                          </div>
                        </div>
              </div>

            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>

</div>
<!--Signup-->

