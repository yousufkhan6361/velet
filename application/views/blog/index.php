<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>
<section>
  <div class="TopGunSec ptop5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-md-12 col-xs-12">
          <div class="centerheading " data-aos="fade-down">
            <span>Your Heading Here</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="GunSliderBox aos-init aos-animate" data-aos="fade-zoom">
            <!-- Itme -->
            <?php
              if (array_filled($blogs)) {
                foreach ($blogs as $key => $value) {
            ?>  
            <div>
              <div class="GunBigBox">
                <div class="GunInner">
                  <img src="<?php echo get_image($value['blog_image_path'], $value['blog_image']);?>" class="img-responsive">
                  <div class="spaceleft">
                  <a href="<?=g('base_url')?>blog/detail/<?=$value['blog_slug']?>"><?=$value['blog_title']?></a>
                  <p><?=$value['blog_title']?></p>
                  <small><a href="<?=g('base_url')?>blog/detail/<?=$value['blog_slug']?>">Read More</a></small>
                  </div>
                </div>
              </div>
            </div>
            <?php
                }
              }
            ?>
            <!-- Itme -->                                   
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
