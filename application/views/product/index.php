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
        <div class="col-md-12 col-md-12 col-xs-12">
          <div class="centerheading " data-aos="fade-down">
            <span>Our Products</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
          </div>
        </div>
      </div>
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

<!-- <section class="product_detail_page all-section related_products_sec">
      <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="cate-sec">
                <h4>Categories</h4>
                <ul>
                  <?php
                    if (array_filled($all_categories)) {
                      foreach ($all_categories as $key => $value) {
                  ?>
                    <li><a href="<?=g('base_url')?>category/<?=$value['category_slug']?>"><?=$value['category_name']?></a></li>
                  <?php
                      }
                    }
                  ?>
                </ul>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <?php
                  if (array_filled($products)) {
                    $x=1;
                    foreach ($products as $key => $value) {
                ?>
                  <div class="col-sm-4">
                    <div class="relate_pro text-center">
                      <a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>">
                      <img src="<?php echo get_image($value['product_image_path'], $value['product_image']);?>" alt=" Product"/>
                      <div class="relate_over">
                        <ul>
                          <li><a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                          <li><a href="<?=g('base_url')?>product/detail/<?=$value['product_slug']?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>
                      <h3><?=$value['product_name']?></h3>
                      </a>
                      <p><?=price($value['product_price'])?></p>
                    </div>
                  </div>
                <?php
                    }
                  }
                  else{
                ?>
                  <h1 class="text-center">No Product found!</h1>
                <?php
                  }
                ?>
              </div>
        </div>
      </div>
    </div>
    </section> -->