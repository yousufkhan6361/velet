<div class="about-sec" id="abt">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft animated" data-wow-duration="2s">
                <div class="abouy-text">
                    <?php echo html_entity_decode($content['cms_page_content']);?>
                    <a href="<?php echo g('base_url');?>digital-printing">See More</a></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight animated" data-wow-duration="2s">
                <div class="abouy-img"><img alt="about" class="img-responsive" src="<?php echo get_image($content['cms_page_image_path'], $content['cms_page_image']);?>"></div>
            </div>
        </div>
    </div>
</div>