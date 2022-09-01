<!-- Banner Section Begin -->
<?php
$this->load->view('widgets/inner_banner');
?>
<!-- Banner Section End -->

<section class="main-honeywal padding-70 cartsec">
  <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                  <th width="33%">Sr. No</th>
                  <th>Product</th>
                  <th colspan="3">PRICE</th>
                <th class="col-md-1"></th>
              </tr>
            </thead>
            <tbody>

              <?php
                  if (isset($wishlist) && array_filled($wishlist)) {
                    foreach ($wishlist as $key => $value) {
                      $param = array();
                      $param['where']['product_id'] = $value['wishlist_product_id'];
                      $product_detail = $this->model_product->find_one_active($param);
                      // debug($product_detail);
                      // debug($value,1);

                ?>
              <tr>
                <td class="imagedivwish" style="display: flex;"><p style="margin-right: 40px;"><?=$key+1?></p><img alt="" class="img-responsive" src="<?php echo get_image($product_detail['product_image_path'],$product_detail['product_image']);?>" width="150" height="150"></td>
                <td><a style="background: none;"href="<?= g('base_url').'product/detail/'.$product_detail['product_slug'];?>"><?=$product_detail['product_name'];?></a>  </td>
                <td> <?=price($product_detail['product_price']);?> </td>
                <td><a href="<?= g('base_url').'product/detail/'.$product_detail['product_slug'];?>" class="btn btn1"> Add to Cart </a></td>
                <td><a href="<?=g('base_url')?>checkout/remove_wishlist/<?=$product_detail['product_id']?>" class="remove"> x </a></td>
              </tr>

              <?php
                    }
                  }
                  else{
                ?>
                <tr><td  colspan="6" class="text-center" style="font-size: 26px;">Wishlist is Empty</td></tr>
                <?php
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</section>