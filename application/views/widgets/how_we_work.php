<div class="row">
          <div class="col-md-8 col-md-offset-2 how-we">
            <h3 class="title wow fadeInLeft" data-wow-duration="3s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 3s; animation-delay: 0.4s; animation-name: fadeInLeft;"><?=$sec5['cms_page_name']?>
            </h3>
            <div class="work-video">
              <a href="">  <img src="<?php echo get_image($sec5['cms_page_image_path'], $sec5['cms_page_image']);?>" alt=""> </a>
              <div class="video-inner">
                <a href="<?=$sec5['cms_page_title']?>" data-fancybox data-caption="Caption for single image">
                <img src="<?=g('images_root')?>video-play.png" alt="" />
                </a>
              </div>
            </div>
          </div>
        </div>