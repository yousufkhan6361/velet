<?php
  $slug = $this->uri->segment(2);
  $slug = str_replace("-", " ", $slug);
?>
<section class="wow fadeInUp inn-slide  animated" style="visibility: visible; animation-name: fadeInUp;">
  <img src="<?php echo get_image($inner_banner['inner_banner_image_path'], $inner_banner['inner_banner_image']);?>" class="img-responsive" alt="">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inn-slide-cap">
          <h3><?=ucwords($slug)?></h3>
          
        </div>
      </div>
    </div>
  </div>
</section>