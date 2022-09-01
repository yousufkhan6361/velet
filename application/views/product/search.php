<?
// Banner heading
// $this->load->view('widgets/inner_banner_category');
// Banner section
$this->load->view('widgets/inner_banner');
$products = $product_info['data'];
// debug($products,1);
?>
<section>
  <div class="OurProduct">
    <div class="container">
      <div class="row">
        <?php
          if (array_filled($products)) {
            foreach ($products as $key => $value) {
        ?>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <div class="productmain aos-init aos-animate" data-aos="zoom-in">
            <div class="productcontent">
              <a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>"><img src="<?php echo get_image($value['product_image_path'], $value['product_image']);?>"></a>
              <a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>"><?=$value['product_name']?></a>
            </div>
            <div class="guncontent">
              <small><del><?=price($value['product_price'])?></del><?=price($value['product_old_price'])?></small>
              <a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>">Add To Cart</a>
            </div>
          </div>
        </div>
        <?php
            }
          }
        ?>                        
      </div>      
    </div>
  </div>
</section>


