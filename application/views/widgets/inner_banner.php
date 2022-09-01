<section>
  <div class="SliderMain SliderMainInner">    
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <div class="SliderImg">
          <img src="<?php echo get_image($inner_banner['inner_banner_image_path'], $inner_banner['inner_banner_image']);?>" alt="Slider" class="img-responsive">
        </div>
          <div class="item active">
            <div class="carousel-caption">
              <div class="container">
                <div class="SliderText wow zoomIn">
                  <span><?=$inner_banner['inner_banner_name']?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
  </div>
</section>