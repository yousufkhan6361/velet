<?
// Banner heading
$this->load->view('widgets/inner_banner_category');
// Banner section
$products = $product_info['data'];
?>
      <!-- section iner start here -->
      <section class="product">
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
              <div class="media-sec">
                <h4>Product</h4>
                <div class="media">
                  <div class="media-left">
                    <img src="<?=g('images_root')?>trend7.jpg" alt="">
                  </div>
                  <div class="media-body">
                    <h5>Salvinia 30+ Leaves</h5>
                    <h6></h6>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <img src="<?=g('images_root')?>trend1.jpg" alt="">
                  </div>
                  <div class="media-body">
                    <h5>Amazon Frogbit 30+ Leaves</h5>
                    <h6></h6>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <img src="<?=g('images_root')?>trend2.jpg" alt="">
                  </div>
                  <div class="media-body">
                    <h5>Japan Blue Gold Double Sword Guppy</h5>
                    <h6>$19.99 – $34.99</h6>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <img src="<?=g('images_root')?>trend5.jpg" alt="">
                  </div>
                  <div class="media-body">
                    <h5>Platinum Dumbo Ear Red Mosaic Guppy</h5>
                    <h6>$23.99 – $34.99</h6>
                  </div>
                </div>
                <div class="media no-border">
                  <div class="media-left">
                    <img src="<?=g('images_root')?>trend3.jpg" alt="">
                  </div>
                  <div class="media-body">
                    <h5>Nebula Steel Metallic Guppy</h5>
                    <h6>$19.99 – $29.99</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4">
                  <div class="sho-div">
                    <ul class="list-inline">
                      <li>Home</li>
                      <li>/</li>
                      <li>Shop</li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="list-seond">
                    <ul class="list-inline">
                      <li>showa <a href="">9/24/36</a></li>
                      <li><a href=""><i class="fa fa-th-large" aria-hidden="true"></i>
                      </a> <a href=""><i class="fa fa-th" aria-hidden="true"></i>
                    </a> <a href=""><i class="fa fa-th" aria-hidden="true"></i>
                  </a></li>
                  <li><select name="" class="form-control" id="">
                    <option value="">Default sorting</option>
                    <option value="">Sort by popularity</option>
                    <option value="">Sort by average rating</option>
                    <option value="">Sort by latest</option>
                    <option value="">Sort by price: low to high</option>
                    <option value="">Sort by price: high to low</option>
                    
                  </select></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col-md-4">
                        <div class="trending-box">
                  <img src="<?=g('images_root')?>trend2.jpg" class="img-responsive" alt="">
                  <div class="carsec">
                    <a href="">Read More</a>
                  </div>
                 
                  <ul>
                    <li><a href=""><i class="fa fa-random" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                    </a></li>
                  </ul>
                   <a href="" class="amzon">Japan Blue Gold Double Sword Guppy</a>
                  <h6>$19.99 – $34.99</h6>
                </div>
              </div>
              <div class="col-md-4">
                <div class="trending-box">
                  <img src="<?=g('images_root')?>trend3.jpg" class="img-responsive" alt="">
                  <div class="carsec">
                    <a href="">Read More</a>
                  </div>
                 
                  <ul>
                    <li><a href=""><i class="fa fa-random" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                    </a></li>
                  </ul>
                   <a href="" class="amzon">Nebula Steel Metallic Guppy
</a>
                  <h6>$19.99 – $34.99</h6>
                </div>
              </div>
              <div class="col-md-4">
               <div class="trending-box">
                  <img src="<?=g('images_root')?>trend11.jpg" class="img-responsive" alt="">
                  <div class="carsec">
                    <a href="">Read More</a>
                  </div>
                  <a href="" class="amzon">Orange Medaka Rice Fish
</a>
                  <h6>$10.00</h6>
                  <ul>
                    <li><a href=""><i class="fa fa-random" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="trending-box">
                  <img src="<?=g('images_root')?>trend5.jpg" class="img-responsive" alt="">
                  <div class="carsec">
                    <a href="">Read More</a>
                  </div>
                  <a href="" class="amzon">Platinum Dumbo Ear Red Mosaic Guppy</a>
                  <h6>$10.00</h6>
                  <ul>
                    <li><a href=""><i class="fa fa-random" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                    </a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="trending-box">
                  <img src="<?=g('images_root')?>trend16.jpg" class="img-responsive" alt="">
                  <div class="carsec">
                    <a href="">Read More</a>


                  </div>
                  <a href="" class="amzon">Red Cap Koi Medaka Rice Fish </a>
                  <h6>$23.99 – $34.99</h6>
                  <ul>
                    <li><a href=""><i class="fa fa-random" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                    </a></li>
                    <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                    </a></li>
                  </ul>
                </div>
              </div>
           
            </div>
          
          
          </div>
        </div>
      </div>
    </div>
  </section>
    <section  class="related-prod">
    <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <h3> RELATED PRODUCTS</h3>
        </div>
      </div>
      <div class="row">
        <div class="related-prod-slider">
          <div>
            <div class="trending-box updat">
              <img src="<?=g('images_root')?>pr1.jpg" class="img-responsive" alt="">
              <div class="carsec mod">
                <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
              </div>
              <a href="" class="amzon">Ammunition</a>
              <h6>$299</h6>
              <ul>
                <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
                </a></li>
                <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a></li>
                <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
                </a></li>
              </ul>
            </div>
          </div>
          <div>     

            <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr2.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
          <div> 
           <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr3.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
           </div>
            <div>
          <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr4.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
          <div> 
           <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr5.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
          <div> 
           <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr6.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
          <div>  
            <div class="trending-box updat">
            <img src="<?=g('images_root')?>pr7.jpg" class="img-responsive" alt="">
            <div class="carsec mod">
              <a href="" class="pull-right"><i class="fa fa-random">  </i></a>
            </div>
            <a href="" class="amzon">Ammunition</a>
            <h6>$299</h6>
            <ul>
              <li><a href=""><i class="fa fa-heart-o" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a></li>
              <li><a href=""><i class="fa fa-search" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
          
        </div>
        
        
      </div>
    </div>
  </section>
  <!-- section iner END -->
  <script>
$('.cate-slider').slick({
infinite: true,
slidesToShow: 3,
dots: true,
slidesToScroll: 3,
});
</script>

<!-- <section class="shopsec">
      <div class="container">
     <div class="row upp-sec acc-div">
        <h3>How to Design Your Dress Shirt</h3>
        <div class="col-md-4">
         <div class="indian-box">
           <img src="<?php echo get_image($content['cms_page_image_path'], $content['cms_page_image_2']);?>" class="img-responsive" alt="">
           <?php echo html_entity_decode($content['cms_page_content']);?>
         </div>
        </div>
         <div class="col-md-4">
         <div class="indian-box">
           <img src="<?php echo get_image($content['cms_page_image_path'], $content['cms_page_image_3']);?>" class="img-responsive" alt="">
           <?php echo html_entity_decode($content['cms_page_other_content']);?>
         </div>
        </div>
         <div class="col-md-4">
         <div class="indian-box">
           <img src="<?php echo get_image($content['cms_page_image_path'], $content['cms_page_image_4']);?>" class="img-responsive" alt="">
           <?php echo html_entity_decode($content['cms_page_other_content_3']);?>
         </div>
        </div>

     </div>

        <div class="row">
          <div class="col-md-10 col-md-offset-1">
         <div class="acc-div">
           <h3>Our Men’s Suits Collection</h3>
  
         </div>
       </div>
        </div>
        <div class="row mrg">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="prod-type">
              <h3>TOOLS</h3>
              <div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      All Categories
                    </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <ul class="nav">
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
                </div>
              </div>
            </div>
            <div class="prd-range">
              <h3>Product Range</h3>
              <div class="cbtn">
                <label class="newclick">£0.00 - £39.99
                  <input type="checkbox" checked="checked">
                  <span class="checkmark"></span>
                </label>
                <label class="newclick">£40.00 - £79.99
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
                <label class="newclick">£40.00 - £79.99
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
                <label class="newclick">£40.00 - £79.99
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="prod-media">
              <h3>Products</h3>
              <?php
                if (array_filled($rest_products)) {
                    foreach ($rest_products as $keyy => $valuee) {
              ?>
                <div class="media">
                    <div class="media-left">
                      <img src="<?php echo get_image($valuee['product_image_path'], $valuee['product_image']);?>" alt="">
                    </div>
                    <div class="media-body">
                      <a href="<?php echo g('base_url');?>product/detail/<?php echo $valuee['product_slug'];?>">
                        <h4><?=$valuee['product_name']?></h4>  
                      </a>
                      <p><?php echo price($valuee['product_price']);?></p>
                    </div>
                </div>
              <?php
                    }
                }
              ?>
            </div>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="row mrgbtm" >

              <?php
                if (array_filled($products)) {
                    foreach ($products as $key => $value) {
              ?>
                <div class="col-md-4">
                    <div class="shopbox">
                      <div class="imgdiv">
                        <img src="<?php echo get_image($value['product_image_path'], $value['product_image']);?>" class="img-responsive" alt="">
                      </div>
                      <h3><?=$value['product_name']?></h3>
                        <p><span></span>  <?php echo price($value['product_price']);?></p>
                        <a href="<?php echo g('base_url');?>product/detail/<?php echo $value['product_slug'];?>">Add To Cart</a>
                    </div>
                  </div>
              <?php
                    }
                }
              ?>
              
            </div>
          </div>
        </div>
      </div>
    </section> -->

