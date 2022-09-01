<!-- About us start  -->

<section class="aboutSec">

    <div class="container">

        <div class="col-md-6 col-xs-12 col-sm-6">

            <?php echo html_entity_decode($about_us['cms_page_content']);?>

            <div class="aboutBtn"><a href="<?php echo g('base_url');?>about-us" class="tc-image-effect-circle">Learn More</a></div>

        </div>

        <div class="col-md-6 col-xs-12 col-sm-6">

            <div class="aboutImg"> <img src="<?php echo get_image($about_us['cms_page_image_path'],$about_us['cms_page_image']);?>" class="img-responsive aboutImg1" alt="img"> <img src="<?php echo get_image($about_us['cms_page_image_path'],$about_us['cms_page_image_2']);?>" class="img-responsive aboutImg2" alt="img"> </div>

        </div>

    </div>

</section>

<!-- About us end  -->